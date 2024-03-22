<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;

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
}
