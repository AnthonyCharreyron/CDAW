<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConnexionController extends MenuController
{
    public function getConnexion(){

        $url = request()->url();
        //Log::info($url);

        return view('template', [
            'currentPage' => $this->getCurrentPage($url),
            'menu' => $this->getMenu(),
        ]);
    }
}
