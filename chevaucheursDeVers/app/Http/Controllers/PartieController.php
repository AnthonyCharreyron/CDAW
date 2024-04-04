<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Partie;
use App\Models\Joue;
use App\Models\User;
use App\Models\CarteJeu;

class PartieController extends Controller
{
    public function getPartieJouee(Request $request, $code_partie){
        $url = request()->url();
        $user = Auth::user();

        $idPartie = Partie::verifyCode($code_partie);

        $participants = Joue::getParticipants($idPartie);
        $listeJoueurs = [];
        foreach ($participants as $participant) {
            $listeJoueurs[] = $participant->pseudo;
        }
        session(['listeJoueurs' => $listeJoueurs]);

        if($request->session()->has('joueurEnCours')){
            $joueurEnCours=session()->get('joueurEnCours');
        } else {
            $joueurEnCours = $participants[0]->pseudo;
            session()->put('joueurEnCours', $joueurEnCours);
        }

        $idHost = Partie::getHostid($code_partie);

        return view('partie', [
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user,
            'partie_commencee' => Partie::estCommencee($code_partie),
            'code_partie' => $code_partie,
            'participants' => $participants,
            'idHost' => $idHost
        ]);
    }

    public function lancerPartie(Request $request){
        $user = Auth::user();
        $code=$request->input('code');
        $idPartie = Partie::verifyCode($code);
        $participants = Joue::getParticipants($idPartie);

        Partie::lancerPartie($code);
        Partie::generateCartesPiocheVisible();
        Partie::initialiserCartesEnMain(4, $user->id);
        $cartesDestinations = Partie::obtenirCartesDestination(3, $participants);
        $cartesDestinationsRestantes = session()->get('cartesDestinationsRestantes');

        Partie::genererPiocheDestinations($cartesDestinationsRestantes);

        Partie::genererCouleurs($participants);

        session(['zonesPrises' => []]);

        Partie::initialiserLesScores($participants);
        Partie::initialiserLesVersAPoser($participants);

        return response()->json([
            "success" => true,
            "message" => "OK partie initialisée",
            "piocheVisibleGlobale" => session()->get('piocheVisibleGlobale'),
            "cartesDestinations" => $cartesDestinations,
            "cartesDestinationsRestantes" => $cartesDestinationsRestantes,
            "piocheDestinations" => session()->get('piocheDestinations'),
            "couleursJoueurs" => session()->get('couleursJoueurs'),
            "scoresJoueurs" => session()->get('scoresJoueurs'),
            "versRestants" => session()->get('versRestants')
        ]);
    }

    public function initialiserCartesMain(Request $request){
        $user=Auth::user();
        Partie::initialiserCartesEnMain(4, $user->id);
        return response()->json([
            "success" => true,
            "message" => "OK cartes en main initialisées"
        ]);
    }

    public function supprimerCarteDestination(Request $request){

        $idUser = $request->input('userId');
        $destinationId = $request->input('destinationId');
        if($destinationId!=null){
            $posUnderscore = strpos($destinationId, '_');
            $id = intval(substr($destinationId, $posUnderscore + 1));
        
            $cartesDestinations = session()->get('cartesDestinationsMain_'.$idUser);
            if ($cartesDestinations) {
                $valeurs = array_values($cartesDestinations);
                $cles = array_keys($cartesDestinations);
                Log::info($cles[$id-1]);

                $cartesDestinationsRestantes = session()->get('cartesDestinationsRestantes');
                $cartesDestinationsRestantes[$cles[$id-1]]=$valeurs[$id-1];
                session()->put('cartesDestinationsRestantes', $cartesDestinationsRestantes);

                array_splice($cartesDestinations, $id - 1, 1);
                session()->put('cartesDestinationsMain_'.$idUser, $cartesDestinations);
            }
        }

        return response()->json([
            "success" => true,
            "message" => "OK fin de mon premier tour",
            "listePseudosParticipants" => session()->get('listeJoueurs'),
            "userPseudo" => User::getPseudo($idUser),
            "cartesDestinationsRestantes" => session()->get('cartesDestinationsRestantes')
        ]);
        
    }

    public function prochainJoueur(Request $request){
        $pseudoProchainJoueur = $request->input('prochainJoueur');
        session()->put('joueurEnCours', $pseudoProchainJoueur);
        return response()->json([
            "success" => true,
            "message" => "OK prochain joueur mis en session"
        ]);
    }  

    public function piocherVer(Request $request){
        $user = Auth::user();
        $indexCarteSelectionnee = $request->input('carteVer');
        $nouvelleCarte = Partie::genererNouvelleCarte();
        $main = session()->get('cartesEnMain_'.$user->id);

        if($indexCarteSelectionnee !== 'pioche'){
            $currentPioche = session()->get('piocheVisibleGlobale');

            array_push($main, $currentPioche[$indexCarteSelectionnee]);
            session()->put('cartesEnMain_'.$user->id, $main);

            $currentPioche[$indexCarteSelectionnee] = $nouvelleCarte;
            session()->put('piocheVisibleGlobale', $currentPioche);
            
        } else {  
            array_push($main, $nouvelleCarte);
            session()->put('cartesEnMain_'.$user->id, $main);
        }

        return response()->json([
            "success" => true,
            "message" => "OK ver pioché",
            "listePseudosParticipants" => session()->get('listeJoueurs'),
            "userPseudo" => User::getPseudo($user->id),
            'nouvelleCarte' => $nouvelleCarte,
            'baseURLimg' => asset('images/'),
            'piocheVisible' => session()->get('piocheVisibleGlobale')
        ]);
    }

    public function piocherDestinations(Request $request){
        $user = Auth::user();
        $destinationsAAjouter = $request->input('cartesDestinations');
        Log::info($destinationsAAjouter);
        $destinationsMain = session()->get('cartesDestinationsMain_'.$user->id);

        $nouvelleMain = array_merge($destinationsMain,$destinationsAAjouter);
        session()->put('cartesDestinationsMain_'.$user->id, $nouvelleMain);

        $cartesDestinationsRestantes = session()->get('cartesDestinationsRestantes');
        $clesAAjouter = array_keys($destinationsAAjouter);
        $cartesDestinationsRestantes = array_diff_key($cartesDestinationsRestantes, array_flip($clesAAjouter));
        session()->put('cartesDestinationsRestantes', $cartesDestinationsRestantes);

        Partie::genererPiocheDestinations($cartesDestinationsRestantes);

        return response()->json([
            "success" => true,
            "message" => "OK fin de mon premier tour",
            "listePseudosParticipants" => session()->get('listeJoueurs'),
            "userPseudo" => User::getPseudo($user->id),
            'cartesDestinationsRestantes' => $cartesDestinationsRestantes,
            "piocheDestinations" => session()->get('piocheDestinations')
        ]);
    }

    public function poserVers(Request $request){
        $user=Auth::user();
        $idZone = $request->input('zode_id');

        $zonesPrises = session()->get('zonesPrises')==null ? array() : session()->get('zonesPrises');
        $scoresJoueurs = session()->get('scoresJoueurs');
        $versRestants = session()->get('versRestants');

        $droitDePrendreZone = CarteJeu::droitZone($user, $idZone, $zonesPrises, $scoresJoueurs, $versRestants);
        if($droitDePrendreZone){
            return response()->json([
                "success" => true,
                "message" => "OK ver posé",
                "listePseudosParticipants" => session()->get('listeJoueurs'),
                "userPseudo" => User::getPseudo($user->id),
                "zonesPrises" => session()->get('zonesPrises'),
                "scoresJoueurs" => session()->get('scoresJoueurs'),
                "versRestants" => session()->get('versRestants')
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Chemin invalide",
            ]);
        }
    }

    public function terminerPartie(Request $request){
        $user=Auth::user();
        $code_partie=$request->input('code_partie');
        $scoresJoueurs=$request->input('scoresJoueurs');
        $id_partie = Partie::verifyCode($code_partie);

        Joue::scoreFinal($id_partie, $scoresJoueurs);
        
        $id_user_gagnant = User::idUserGagnant($scoresJoueurs);
        Partie::updatePartieTerminee($idPartie, $id_user_gagnant);

        fermerSessions();
        foreach ($scoresJoueurs as $pseudo => $score) {
            if($pseudo!==$user->pseudo){
                $id=(User::findUser($pseudo))->id;
                $request->session()->forget('cartesDestinationsMain_'.$id);
            }     
        }

        return response()->json([
            "success" => true,
            "message" => "OK partie terminée",
        ]);
    }

    public function fermerSessions(){
        $user=Auth::user();

        $request->session()->forget('participant');
        $request->session()->forget('listeJoueurs');
        $request->session()->forget('joueurEnCours');
        $request->session()->forget('piocheVisibleGlobale');
        $request->session()->forget('cartesDestinationsRestantes');
        $request->session()->forget('piocheDestinations');
        $request->session()->forget('couleursJoueurs');
        $request->session()->forget('zonesPrises');
        $request->session()->forget('scoresJoueurs');
        $request->session()->forget('versRestants');
        $request->session()->forget('cartesEnMain_'.$user->id);
        $request->session()->forget('cartesDestinationsMain_'.$user->id);

        return response()->json([
            "success" => true,
            "message" => "OK partie terminée",
        ]);  
    }
 

}
