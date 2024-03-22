<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\User;


class HistoriqueController extends MenuController
{
    public function getClassement(){

        $url = request()->url();
        //Log::info($url);

        return view('historique', [
            'currentPage' => $this->getCurrentPage($url),
            'menu' => $this->getMenu(),
        ]);
    }

    public function statClassement($id){

        $data = User::statClassement();
        echo json_encode(array("data" => $data));
    }
}
