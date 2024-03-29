<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Partie;
use App\Models\Joue;

class PartieController extends Controller
{
    public function getPartieJouee(Request $request, $code_partie){
        $url = request()->url();
        $user = Auth::user();

        $idPartie = Partie::verifyCode($code_partie);

        $participants = Joue::getParticipants($idPartie);

        return view('partie', [
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user,
            'partie_commencee' => Partie::estCommencee($code_partie),
            'code_partie' => $code_partie,
            'participants' => $participants
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

        return response()->json([
            "success" => true,
            "message" => "OK partie initialisée",
            "piocheVisibleGlobale" => session()->get('piocheVisibleGlobale'),
            "cartesDestinations" => $cartesDestinations,
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

        $posUnderscore = strpos($destinationId, '_');
        $id = intval(substr($destinationId, $posUnderscore + 1));
    
        $cartesDestinations = session()->get('cartesDestinationsMain_'.$idUser);
        if ($cartesDestinations) {
            array_splice($cartesDestinations, $id - 1, 1);
            session()->put('cartesDestinationsMain_'.$idUser, $cartesDestinations);
        }
        
    }
    
 

}
