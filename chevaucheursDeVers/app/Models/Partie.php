<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partie extends Model
{
    use HasFactory;

    protected $table = 'partie';
    protected $primaryKey = 'id_partie';

    public static function createPartie($idUser, $estPrivee, $date){
        $idPartie = self::insertGetId(
            [
                'id_partie' => null,
                'date_partie' => $date,
                'code' => Str::random(10),
                'partie_privee' => $estPrivee,
                'est_commencee' => 0,
                'est_terminee' => 0,
                'id_user_gagnant' => null
            ]
        );
        Joue::userJouePartie($idUser, $idPartie);
    }
}
