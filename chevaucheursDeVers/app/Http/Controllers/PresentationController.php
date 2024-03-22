<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class PresentationController extends MenuController
{
    public function getPresentation(){

        $url = request()->url();
        //Log::info($url);

        $user = Auth::user();

        return view('presentation', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'user' => $user
        ]);
    }
}
