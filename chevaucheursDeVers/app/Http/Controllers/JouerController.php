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

        $estPrivee = $request->has('partie-privee');
        $tempsParCoup = $request->input('temps-coup');
        $nombreJoueurs = $request->input('nombre-joueurs');
        $idHost = $request->input('hostId');

        $dateDuJour = Carbon::now();
        $date = $dateDuJour->format('Y-m-d');
        
        $codePartie = Partie::createPartie($user->id, $estPrivee, $date, $nombreJoueurs, $tempsParCoup, $idHost);
        
        return redirect()->to('/jouer/lobby/'.$codePartie)->with([
            "success" => true,
            "message" => "OK partie créée",
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
            "participants" => Joue::getParticipants($idPartie),
            "nombre_joueurs_max" => Partie::getNombreJoueurs($idPartie),
            "nb_joueurs" => Joue::countNbJoueurs($idPartie),
        ]);
    }

    
    public function rejoindrePartie(Request $request){
        $user = Auth::user();
        $codePartie = $request->input('partie_code');

        $idPartie = Partie::verifyCode($codePartie);
        
        if ($idPartie != 0){
            $estParticipant = Joue::estParticipant($idPartie, $user->id);
            if(!$estParticipant){
                $nbJoueursMaxAtteint = Joue::countNbJoueurs($idPartie)===Partie::getNombreJoueurs($idPartie)? 1: 0;
                if($nbJoueursMaxAtteint){
                    return response()->json([
                        "success" => false,
                        "message" => "Partie complète"
                    ]);
                }
                Joue::userJouePartie($user->id, $idPartie);
            }
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
            "message" => "Partie introuvable"
        ]);
    }

    public function getInfoParties(){
        
        $parties_infos = Partie::getInfoParties();

        echo json_encode(array("data" => $parties_infos));
    }

}
