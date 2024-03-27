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
            'user' => $user
        ]);
    }

    public function createPartie(Request $request){

        $user = Auth::user();

        $estPrivee = $request->input('partie_privee');
        $tempsParCoup = $request->input('partie_tpsParCoup');
        $nombreJoueurs = $request->input('partie_nbJoueurs');
        $idHost = $request->input('id_user_host');

        $dateDuJour = Carbon::now();
        $date = $dateDuJour->format('Y-m-d');
        
        $codePartie = Partie::createPartie($user->id, $estPrivee, $date, $nombreJoueurs, $tempsParCoup, $idHost);
        
        return response()->json([
            "success" => true,
            "message" => "OK partie créée",
            "redirect_url" => "/jouer/lobby/" . $codePartie,
            "codePartie" => $codePartie,
            "pseudo" => $user->pseudo
        ]);

    }
    
    public function getLobby($codePartie){
        $url = request()->url();
        $user=Auth::user();
        $idHost = Partie::getHostid($codePartie);
        $idPartie = Partie::verifyCode($codePartie);

        return view('lobby', [
            'currentPage' => 'Jouer',
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'code_partie' => $codePartie,
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'idHost' => $idHost, 
            'userId' => $user->id,
            "participants" => Joue::getParticipantsPseudos($idPartie),
            "nombre_joueurs_max" => Partie::getNombreJoueurs($idPartie),
            "nb_joueurs" => Joue::countNbJoueurs($idPartie),
        ]);
    }

    
    public function rejoindrePartie(Request $request){
        $user = Auth::user();
        $codePartie = $request->input('partie_code');

        $idPartie = Partie::verifyCode($codePartie);
        
        if ($idPartie != 0){
            Joue::userJouePartie($user->id, $idPartie);
            session(['participant' => $codePartie.'_'.$user->id]);           
            return response()->json([
                "success" => true,
                "message" => "OK partie rejointe",
                "redirect_url" => "/jouer/lobby/" . $codePartie,
                "pseudo" => $user->pseudo,
                "nb_joueurs" => Joue::countNbJoueurs($idPartie),
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
