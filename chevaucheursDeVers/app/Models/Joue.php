<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasCompositePrimaryKey;


class Joue extends Model
{
    use HasFactory;

    protected $table = 'joue';
    protected $primaryKey = array('id_partie', 'id_user');

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
        return self::select('id_user')
                            ->where('id_partie', '=', $idPartie)
                            ->get();
    }

}
