<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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
        $parties = DB::table('partie')
                    ->select('partie.code', 'partie.nombre_joueurs', 'partie.temps_par_coup', DB::raw('COUNT(joue.id_user) as nombre_utilisateurs_lobby'))
                    ->leftJoin('joue', 'joue.id_partie', '=', 'partie.id_partie')
                    ->where('partie.partie_privee', 0)
                    ->where('partie.est_commencee', 0)
                    ->groupBy('partie.code', 'partie.nombre_joueurs', 'partie.temps_par_coup')
                    ->havingRaw('partie.nombre_joueurs > COUNT(joue.id_user)')
                    ->get();
        return $parties;
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
        $cartesRestantes = $nomsCartes;
    
        foreach ($participants as $user) {
            $cartes = [];
            
            for ($i = 0; $i < $nombreCarte; $i++) {
                $destination = array_rand($cartesRestantes);
                $score = $cartesRestantes[$destination];
                $cartes[$destination] = $score;
                unset($cartesRestantes[$destination]);
            }
        
            session(['cartesDestinationsMain_' . $user->id_user => $cartes]);
            $result['cartesDestinationsMain_' . $user->id_user] = $cartes;
        }

        session(['cartesDestinationsRestantes' => $cartesRestantes]);
    
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

    public static function genererNouvelleCarte(){
        $nomsCartes = ['Carte ver bleu', 'Carte ver jaune', 'Carte ver multicolore', 'Carte ver rose', 'Carte ver rouge', 'Carte ver vert'];
 
        $carte = $nomsCartes[rand(0,5)]; 
        
        return $carte;
    }

    public static function genererPiocheDestinations($cartesDestinationsRestantes){
        $cles = array_keys($cartesDestinationsRestantes);
        $valeurs = array_values($cartesDestinationsRestantes);
        $indicesAleatoires = array_rand($cles, 3);

        $destinationsAleatoires = [];

        foreach ($indicesAleatoires as $indice) {
            $cle = $cles[$indice];
            $valeur = $valeurs[$indice];
            $destinationsAleatoires[$cle] = $valeur;
        }
        session(['piocheDestinations' => $destinationsAleatoires]);
    }

    public static function genererCouleurs($participants){
        $couleursVers = ['bleu', 'jaune', 'rouge', 'violet', 'vert'];

        $couleursJoueurs=[];

        foreach($participants as $index => $participant){
            $couleursJoueurs[$participant->pseudo]=$couleursVers[$index];
        }
        session(['couleursJoueurs' => $couleursJoueurs]);
    }

    public static function initialiserLesScores($participants){
        $score = [];
        foreach($participants as $participant){
            $score[$participant->pseudo]=0;
        }

        session(['scoresJoueurs' => $score]);
    }

    public static function initialiserLesVersAPoser($participants){
        $versRestants = [];
        foreach($participants as $participant){
            $versRestants[$participant->pseudo]=35;
        }

        session(['versRestants' => $versRestants]);
    }

    public static function updatePartieTerminee($idPartie, $id_user_gagnant){
        self::where('id_partie', $id_partie)
            ->update([
                'est_terminee' => 1,
                'id_user_gagnant' => $id_user_gagnant
            ]);
    }
}
