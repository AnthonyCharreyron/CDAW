<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Partie;

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

    public function initiliserMesCartes(Request $request){
        Partie::generateCartesPiocheVisible();
        Partie::initialiserCartesEnMain(4,$user->id);
        Partie::obtenirCartesDestination(3, $user->id);
    }

    public function lancerPartie(Request $request){
        Partie::lancerPartie($request->input('code'));
    }
 

}
