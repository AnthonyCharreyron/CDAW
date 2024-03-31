<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public static function isConnected(){
        return Auth::user()!=null;
    }

    public function createUser(Request $request){
        User::createUser($request->input('inscription-pseudo'),$request->input('inscription-email'),$request->input('inscription-password'));
        return redirect()->intended('connexion');
    }

    public static function getUserPhoto($userId){
        return User::getUserPhoto($userId);
    }
}
