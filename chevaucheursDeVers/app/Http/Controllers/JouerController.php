<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Models\Partie;
use App\Models\Joue;

class JouerController extends MenuController
{
    public function getPartie(){

        $url = request()->url();
        //Log::info($url);

        return view('jouer', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
        ]);
    }

    public function createPartie(Request $request){

        $user = Auth::user();

        $estPrivee = $request->input('partie_privee');
        $tempsParCoup = $request->input('partie_tpsParCoup');
        $nombreJoueurs = $request->input('partie_nbJoueurs');


        $dateDuJour = Carbon::now();
        $date = $dateDuJour->format('Y-m-d');
        
        Partie::createPartie($user->id, $estPrivee, $date, $nombreJoueurs, $tempsParCoup);
        return response()->json([
            "success" => true,
            "message" => "OK partie créée"
        ]);

    }

    public function setPartie(){
        $url = request()->url();
        Log::info($url);

        return view('template', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
        ]);
    }

    
    public function rejoindrePartie(Request $request){
        $user = Auth::user();
        $codePartie = $request->input('partie_code');

        $partieExistante = Partie::verifyCode($codePartie);
        
        if ($partieExistante != 'false'){
            Joue::userJouePartie($user->id, $partieExistante);
            return response()->json([
                "success" => true,
                "message" => "OK partie rejointe"
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Le code donnée n'est pas bon"
        ]);
    }
}
