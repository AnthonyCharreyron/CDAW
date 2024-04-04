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

        return view('partie', [
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user,
            'partie_commencee' => Partie::estCommencee($code_partie),
            'code_partie' => $code_partie,
            'participants' => $participants,
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

        return response()->json([
            "success" => true,
            "message" => "OK partie initialisée",
            "piocheVisibleGlobale" => session()->get('piocheVisibleGlobale'),
            "cartesDestinations" => $cartesDestinations,
            "cartesDestinationsRestantes" => $cartesDestinationsRestantes,
            "piocheDestinations" => session()->get('piocheDestinations'),
            "couleursJoueurs" => session()->get('couleursJoueurs')
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
 

}
