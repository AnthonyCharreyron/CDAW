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

    public static function createPartie($idUser, $estPrivee, $date, $nombreJoueurs, $tempsParCoup){
        $codePartie = Str::random(10);
    
        $idPartie = self::insertGetId([
            'date_partie' => $date,
            'code' => $codePartie,
            'partie_privee' => $estPrivee,
            'est_commencee' => 0,
            'est_terminee' => 0,
            'id_user_gagnant' => null,
            'nombre_joueurs' => $nombreJoueurs,
            'temps_par_coup' => $tempsParCoup
        ]);
    
        Joue::userJouePartie($idUser, $idPartie);
    
        return $codePartie;
    }
    

    public static function verifyCode($codePartie){
        $partie = self::where('code', $codePartie)->first();

        return $partie ? $partie->id_partie : 0;
    }

    public static function getInfoParties(){
        $partie = self::select('id_partie', 'nombre_joueurs', 'temps_par_coup', 'code')
                        ->where('partie_privee', 0)
                        ->where('est_commencee', 0)
                        ->get();
        return $partie;
    }
}
