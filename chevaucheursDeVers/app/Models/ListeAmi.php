<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeAmi extends Model
{
    use HasFactory;

    protected $table = 'liste_ami';
    public $timestamps = false;

    public static function getListeAmis($user) {
        return self::select(\DB::raw('IF(id1 = '.$user->id.', id2, id1) AS ami_id'), 'users.pseudo', 'users.photo_profil')
                    ->leftJoin('users', function($join) use ($user) {
                        $join->on('users.id', '=', \DB::raw('IF(liste_ami.id1 = '.$user->id.', liste_ami.id2, liste_ami.id1)'));
                    })
                    ->where(function($query) use ($user) {
                        $query->where('id1', '=', $user->id)
                              ->orWhere('id2', '=', $user->id);
                    })
                    ->where('est_accepte', '=', 1)
                    ->get();
    }
    

    public static function getDemandePourMoi($user){
        return self::select('users.id as id', 'users.pseudo', 'users.photo_profil')
                    ->leftJoin('users', function($join) use ($user) {
                        $join->on('users.id', '=', \DB::raw('IF(liste_ami.id1 = '.$user->id.', liste_ami.id2, liste_ami.id1)'));
                    })
                    ->where(function ($query) use ($user) {
                        $query->where('liste_ami.id1', $user->id)
                              ->orWhere('liste_ami.id2', $user->id);
                    })
                    ->where('liste_ami.est_accepte', 0)
                    ->where('liste_ami.id_demandeur', '!=', $user->id)
                    ->get();
    }
      

    public static function accepterDemande($idUser, $id_user_friend){
        self::where(function($query) use ($idUser, $id_user_friend) {
                $query->where('id1', '=', $idUser)
                    ->where('id2', '=', $id_user_friend);
            })
            ->orWhere(function($query) use ($idUser, $id_user_friend) {
                $query->where('id1', '=', $id_user_friend)
                    ->where('id2', '=', $idUser);
            })
            ->update([
                'est_accepte' => 1,
            ]);
    }

    public static function refuserDemande($idUser, $id_user_friend){
        self::where(function($query) use ($idUser, $id_user_friend) {
                $query->where('id1', '=', $idUser)
                      ->where('id2', '=', $id_user_friend);
            })
            ->orWhere(function($query) use ($idUser, $id_user_friend) {
                $query->where('id1', '=', $id_user_friend)
                      ->where('id2', '=', $idUser);
            })
            ->delete();
    }

    public static function newRelation($idUser,$idUserFriend){
        self::insert(
            [
                'id1' => $idUser,
                'id2' => $idUserFriend,
                'est_accepte' => 0,
                'id_demandeur' => $idUser
            ]
        );
    }

}
