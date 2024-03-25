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
        $user=Auth::user();

        return view('jouer', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
        ]);
    }

    public function createPartie(Request $request){

        $user = Auth::user();

        $estPrivee = $request->input('partie_privee');
        $tempsParCoup = $request->input('partie_tpsParCoup');
        $nombreJoueurs = $request->input('partie_nbJoueurs');

        $dateDuJour = Carbon::now();
        $date = $dateDuJour->format('Y-m-d');
        
        $codePartie = Partie::createPartie($user->id, $estPrivee, $date, $nombreJoueurs, $tempsParCoup);
        return response()->json([
            "success" => true,
            "message" => "OK partie créée",
            "redirect_url" => "/jouer/lobby/" . $codePartie
        ]);

    }
    
    public function getLobby($codePartie){
        $url = request()->url();

        return view('lobby', [
            'currentPage' => 'Jouer',
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'code_partie' => $codePartie
        ]);
    }

    
    public function rejoindrePartie(Request $request){
        $user = Auth::user();
        $codePartie = $request->input('partie_code');

        $partieExistante = Partie::verifyCode($codePartie);
        
        if ($partieExistante != 0){
            Joue::userJouePartie($user->id, $partieExistante);
            return response()->json([
                "success" => true,
                "message" => "OK partie rejointe",
                "redirect_url" => "/jouer/lobby/" . $codePartie
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Le code donnée n'est pas bon"
        ]);
    }

    public function getInfoParties(){
        
        $parties_infos = Partie::getInfoParties();

        echo json_encode(array("data" => $parties_infos));


    }
}
