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

    public static function createPartie($idUser, $estPrivee, $date, $nombreJoueurs, $tempsParCoup, $idHost){
        $codePartie = Str::random(10);
    
        $idPartie = self::insertGetId([
            'date_partie' => $date,
            'code' => $codePartie,
            'partie_privee' => $estPrivee,
            'est_commencee' => 0,
            'est_terminee' => 0,
            'id_user_gagnant' => null,
            'nombre_joueurs' => $nombreJoueurs,
            'temps_par_coup' => $tempsParCoup, 
            'id_user_host' => $idHost
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

    public static function getHostId($code){
        $hostId = self::select('id_user_host')
                    ->where('code', '=', $code)
                    ->value('id_user_host');
        return $hostId;
    }

    public static function generateCartesPiocheVisible(){
        $nomsCartes = ['Carte ver bleu', 'Carte ver jaune', 'Carte ver multicolore', 'Carte ver rose', 'Carte ver rouge', 'Carte ver vert'];
        $cartes = [];

        for($i=0; $i<5; $i++){
            $carte = $nomsCartes[rand(0,5)]; 
            array_push($cartes, $carte);
        }
        return $cartes;
    }
    
}
