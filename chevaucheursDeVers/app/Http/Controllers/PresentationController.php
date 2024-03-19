<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PresentationController extends MenuController
{
    public function getPresentation(){

        $url = request()->url();
        //Log::info($url);

        return view('presentation', [
            'currentPage' => $this->getCurrentPage($url),
            'menu' => $this->getMenu(),
        ]);
    }
}
