<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;

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
}
