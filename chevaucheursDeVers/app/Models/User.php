<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        $data = self::select('users.pseudo', DB::raw('MAX(j.score) as meilleur_score'))
            ->leftJoin(DB::raw('(SELECT id, MAX(score) AS score FROM joue GROUP BY id) as j'), 'users.id', '=', 'j.id')
            ->groupBy('users.id', 'users.pseudo')
            ->orderBy('meilleur_score', 'DESC')
            ->get();

        return $data;
    }
    public static function statClassementGagnants(){
        $data = '';

        return $data;
    }
}
