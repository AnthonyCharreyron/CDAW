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
    
    public static function initialiserCartesEnMain($nombreCarte, $idPartie, $participants){
        $nomsCartes = ['Carte ver bleu', 'Carte ver jaune', 'Carte ver multicolore', 'Carte ver rose', 'Carte ver rouge', 'Carte ver vert'];
        foreach($participants as $user){
            $cartes = [];

            for($i=0; $i<$nombreCarte; $i++){
                $carte = $nomsCartes[rand(0,5)]; 
                array_push($cartes, $carte);
            }

            session(['cartesEnMain_'.$user->id_user => $cartes]);
        }

        
    }

    public static function obtenirCartesDestination($nombreCarte, $idPartie, $participants){
        $nomsCartes = ["Sietch Tabr-Territoire des vers","Caladan-Terre du Sud","Sihaya-Faux mur du Sud","Sietch Tabr-Plaine funèbre","Sihaya-Montagne Chin","Sihaya-Carthag","Arsunt-Observatoire","Territoire des vers-Bassin Impérial","Sietch de Tuek-Base météorologique","Sietch de Tuek-Grotte des oiseaux","Grotte des oiseaux-Pole Nord","Barrière-Base météorologique","Sietch Tabr-Réserve d'épices","Kaitain-Faux mur du Sud","Plaine funèbre-Bassin Impérial","Sietch Tabr-Sietch de Tuek","Petit Erg-Observatoire","Montagne Chin-Carthag","Grotte des oiseaux-Tsimpo","Tsimpo-Mont idaho"];
        foreach($participants as $user){
            $cartes = [];

            for($i = 0; $i < $nombreCarte; $i++){
                $index = array_rand($nomsCartes);
                $carte = $nomsCartes[$index];
                array_push($cartes, $carte);
                array_splice($nomsCartes, $index, 1);
            }
            session(['cartesDestinationsMain_'.$user->id_user => $cartes]);
        }
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
}
