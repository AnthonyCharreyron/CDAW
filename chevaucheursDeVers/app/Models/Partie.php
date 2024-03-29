<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Partie extends Model
{
    use HasFactory;

    protected $table = 'partie';
    protected $primaryKey = 'id_partie';
    public $timestamps = false;

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
        
        session(['participant' => $codePartie.'_'.$idUser]);
    
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
        session(['piocheVisibleGlobale' => $cartes]);
    }
    
    public static function initialiserCartesEnMain($nombreCarte, $idUser){
        $nomsCartes = ['Carte ver bleu', 'Carte ver jaune', 'Carte ver multicolore', 'Carte ver rose', 'Carte ver rouge', 'Carte ver vert'];

        $cartes = [];

        for($i=0; $i<$nombreCarte; $i++){
            $carte = $nomsCartes[rand(0,5)]; 
            array_push($cartes, $carte);
        }

        session(['cartesEnMain_'.$idUser => $cartes]);
        

        
    }

    public static function obtenirCartesDestination($nombreCarte, $participants) {
        $nomsCartes = [
            "Sietch Tabr-Territoire des vers" => 15,
            "Caladan-Terre du Sud" => 17,
            "Sihaya-Faux mur du Sud" => 11,
            "Sietch Tabr-Plaine funèbre" => 14,
            "Sihaya-Montagne Chin" => 8,
            "Sihaya-Carthag" => 12,
            "Arsunt-Observatoire" => 10,
            "Territoire des vers-Bassin Impérial" => 9,
            "Sietch de Tuek-Base météorologique" => 5,
            "Sietch de Tuek-Grotte des oiseaux" => 11,
            "Grotte des oiseaux-Pole Nord" => 12,
            "Barrière-Base météorologique" => 13,
            "Sietch Tabr-Réserve d'épices" => 11,
            "Kaitain-Faux mur du Sud" => 7,
            "Plaine funèbre-Bassin Impérial" => 9,
            "Sietch Tabr-Sietch de Tuek" => 20,
            "Petit Erg-Observatoire" => 11,
            "Montagne Chin-Carthag" => 18,
            "Grotte des oiseaux-Tsimpo" => 17,
            "Sietch Gara Kulon-Trou dans la pierre" => 13
        ];
    
        $result = [];
    
        foreach ($participants as $user) {
            $cartes = [];
            $cartesRestantes = $nomsCartes;
            
            for ($i = 0; $i < $nombreCarte; $i++) {
                $destination = array_rand($cartesRestantes);
                $score = $cartesRestantes[$destination];
                $cartes[$destination] = $score;
                unset($cartesRestantes[$destination]);
            }
            
            session(['cartesDestinationsMain_' . $user->id_user => $cartes]);
            $result['cartesDestinationsMain_' . $user->id_user] = $cartes;
        }
    
        return $result;
    }
    
    

    public static function estCommencee($codePartie){
        $bool = self::select('est_commencee')
                    ->where('code', '=', $codePartie)
                    ->value('est_commencee');
        
        return $bool;
    }

    public static function lancerPartie($code){
        self::where('code', '=', $code)
            ->update([
                'est_commencee' => 1,
            ]);
    }

    public static function getNombreJoueurs($idPartie){
        return self::select('nombre_joueurs')
                    ->where('id_partie', '=', $idPartie)
                    ->value('nombre_joueurs');
    }
}
