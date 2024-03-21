<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PresentationController extends MenuController
{
    public function getPresentation(){

        $url = request()->url();
        //Log::info($url);

        $user = Auth::user();

        return view('presentation', [
            'currentPage' => $this->getCurrentPage($url),
            'menu' => $this->getMenu(),
            'user' => $user
        ]);
    }
}
