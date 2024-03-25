<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class HistoriqueController extends MenuController
{
    public function getClassement(){

        $url = request()->url();
        //Log::info($url);
        $user=Auth::user();

        return view('historique', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
        ]);
    }

    public function statClassement($id){
        if($id==1){
            $data = User::statClassementScores();
            echo json_encode(array("data" => $data));
        }elseif($id==2){
            $data = User::statClassementGagnants();
            echo json_encode(array("data" => $data));
        }else{
           return;
        }
        
    }
}
