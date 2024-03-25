<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Partie;

class PartieController extends Controller
{
    public function getPartieJouee(){
        $url = request()->url();
        $user = Auth::user();
        $piocheVisible = Partie::generateCartesPiocheVisible();
        Log::info($piocheVisible);

        return view('partie', [
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user,
            'piocheVisible' => $piocheVisible,
        ]);
    }
}
