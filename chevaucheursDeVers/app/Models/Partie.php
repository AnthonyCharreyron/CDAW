<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    use HasFactory;

    protected $table = 'partie';
    protected $primaryKey = 'id_partie';

    public static function createPartie($estPrivee, $date){
                self::insert(
            [
                'id_partie' => null,
                'date_validation' => $date->toDateString(),
                'code' => 'hrjgfdlkjh',
                'partie_privee' => $estPrivee,
                'est_commencee' => 0,
                'est_terminee' => 0,
                'gagnant' => null
            ]
        );
    }
}
