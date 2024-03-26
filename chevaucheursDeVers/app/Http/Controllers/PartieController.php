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

        return view('partie', [
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user,
            'partie_commencee' => Partie::estCommencee($code_partie),
            'code_partie' => $code_partie,
        ]);
    }

    public function lancerPartie(Request $request){
        $code=$request->input('code');
        $idPartie = Partie::verifyCode($code);
        $participants = Joue::getParticipants($idPartie);

        Partie::lancerPartie($code);
        Partie::generateCartesPiocheVisible();
        Partie::initialiserCartesEnMain(4, $idPartie, $participants);
        Partie::obtenirCartesDestination(3, $idPartie, $participants);

    Log::info('Test1');

        return response()->json([
            "success" => true,
            "message" => "OK partie initialisée",
            "piocheVisibleGlobale" => session()->get('piocheVisibleGlobale')
        ]);
    }
 

}
