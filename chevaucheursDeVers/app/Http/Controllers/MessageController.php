<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $pseudo = $user ? $user->pseudo : 'Anonymous';
        $message = $request->input('message');
        return response()->json(['success' => true, 'pseudo' =>$pseudo, 'message' => $message]);
    }
}
