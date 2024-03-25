<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

class MonProfilController extends MenuController
{
    public function getProfil(){
        $url = request()->url();
        $user=Auth::user();

        return view('monProfil', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user
        ]);
    }
}
