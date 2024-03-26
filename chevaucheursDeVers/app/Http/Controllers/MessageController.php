<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $pseudo = $user ? $user->pseudo : 'Anonymous';
        $message = $request->input('message');
        return response()->json(['success' => true, 'pseudo' =>$pseudo, 'message' => $message]);
    }

    public function miseEnSessionCartes(Request $request){
        // Récupérer les cartes depuis la requête
        $cartes = $request->input('cartes');
        $cartesArray = array_map('trim', explode(',', $cartes));
        $cartesIndexees = array_values($cartesArray);
        session(['piocheVisibleGlobale' => $cartesIndexees]);
    
        Log::info('test6 : ', [$cartesIndexees]);
    }
    
}
