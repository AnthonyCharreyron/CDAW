<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;

use App\Models\User;


class HistoriqueController extends MenuController
{
    public function getClassement(){

        $url = request()->url();
        //Log::info($url);

        return view('historique', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
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
