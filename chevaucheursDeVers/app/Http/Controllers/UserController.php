<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public static function isConnected(){
        return Auth::user()!=null;
    }

    public function createUser(Request $request){
        User::createUser($request->input('pseudo'),$request->input('email'),$request->input('password'));
    }

    public static function getUserPhoto($userId){
        return User::getUserPhoto($userId);
    }
}
