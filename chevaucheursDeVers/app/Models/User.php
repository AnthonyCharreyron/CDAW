<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function isAdministrateur($user){
        $isAdmin = self::where('pseudo', $user)
                        ->value('est_administrateur');
        
        return $isAdmin;
    }

    public static function statClassementScores(){
        $data = self::select('users.id', 'users.pseudo', DB::raw('MAX(joue.score) AS meilleur_score'))
                    ->leftJoin('joue', 'users.id', '=', 'joue.id_user')
                    ->groupBy('users.id', 'users.pseudo')
                    ->orderBy('meilleur_score', 'DESC')
                    ->get();
        return $data;
    }
    public static function statClassementGagnants(){
        $data = self::select('users.id', 'users.pseudo', DB::raw('COALESCE(COUNT(partie.id_partie), 0) AS nombre_parties_gagnees'))
            ->leftJoin('partie', 'users.id', '=', 'partie.id_user_gagnant')
            ->groupBy('users.id', 'users.pseudo')
            ->orderBy('nombre_parties_gagnees', 'DESC')
            ->get();

        return $data;
    }

    //TODO : traiter cas où il y a déjà un compte avec ce pseudo ou cet email 
    public static function createUser($pseudo, $email, $password){
        self::insert(
            [
                'pseudo' => $pseudo,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public static function getUserPhoto($userId){
        $photo_profil = self::select('photo_profil')
                            ->where('id','=', $userId)
                            ->value('photo_profil');
        return $photo_profil;
    }

    //TODO : traiter cas où il y a déjà un compte avec ce pseudo
    public static function updateUser($pseudo, $password, $email){
        self::where('email', '=', $email)
            ->update([
                'pseudo' => $pseudo,
                'password' => Hash::make($password),
            ]);
    }

    public static function getAllInfos(){
        $users = self::select('id', 'pseudo', 'est_bloque', 'est_administrateur', 'commentaires')
                ->get();
        return $users;
    }

    public static function putAdmin($idUser){
        self::where('id', '=', $idUser)
            ->update([
                'est_administrateur' => 1
            ]);
    }

    public static function blockUser($idUser){
        self::where('id', '=', $idUser)
            ->update([
                'est_bloque' => 1
            ]);
    }

    public static function updateComment($idUser, $commentaires){
        self::where('id', '=', $idUser)
            ->update([
                'commentaires' => $commentaires,
            ]);
    }
    
}
