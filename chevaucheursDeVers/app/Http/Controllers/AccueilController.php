<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends MenuController
{
    public function getPresentation(){

        return view('template', [
            'menu' => $this->getMenu(),
        ]);
    }


   
}
