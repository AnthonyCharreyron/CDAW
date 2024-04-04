<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasCompositePrimaryKey;

use App\Models\User;

class Joue extends Model
{
    use HasFactory;

    protected $table = 'joue';
    //protected $primaryKey = ['id_partie', 'id_user'];
    public $timestamps = false;

    public static function userJouePartie($idUser, $idPartie){
        self::insert(
            [
                'id_partie' => $idPartie,
                'id_user' => $idUser,
                'score' => 0
            ]
        );
    }

    public static function getParticipants($idPartie){
        return self::select('id_user', 'pseudo')
                    ->leftJoin('users', 'users.id', '=', 'joue.id_user')
                    ->where('id_partie', $idPartie)
                    ->get();
    }

    public static function estParticipant($idPartie, $idUser){
        return self::where('id_partie', $idPartie)
                    ->where('id_user', $idUser)
                    ->exists();
    }


    public static function countNbJoueurs($idPartie){
        return self::where('id_partie', $idPartie)->count('id_user');
    }

    public static function scoreFinal($id_partie, $scoresJoueurs){
        foreach($scoresJoueurs as $pseudo => $score){
            $user = User::findUser($pseudo);
            if($user){
                $id_user = $user->id;
                self::where('id_user', $id_user)
                    ->where('id_partie', $id_partie)
                    ->update(['score' => $score]);
            } else {
                // Gérer le cas où l'utilisateur n'est pas trouvé
                Log::info("Utilisateur introuvable pour le pseudo : $pseudo");
            }
        } 
    }
    

}
