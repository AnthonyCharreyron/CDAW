<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Http\Controllers\UserController;
use App\Models\Partie;

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

    public function createPartie(Request $request){

        $estPrivee=$request->input('partie_privee');
        Log::info($estPrivee);
        $dateDuJour = Carbon::now();
        $date = $dateDuJour->format('Y-m-d');
        
        Partie::createPartie($estPrivee, $date);
        return response()->json([
            "success" => true,
            "message" => "OK partie créée"
        ]);

    }
}
