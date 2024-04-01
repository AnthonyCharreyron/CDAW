<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends MenuController
{
    public static function isConnected(){
        return Auth::user()!=null;
    }

    public function createUser(Request $request){

        $url = request()->url();

        $pseudo = $request->input('inscription-pseudo');
        $email = $request->input('inscription-email');
        $password = $request->input('inscription-password');

        if(User::pseudoAlreadyUsed($pseudo)){
            return view('inscription', [
                'error' => 'Ce pseudo a déjà été utilisé',
                'currentPage' => $this->getCurrentPage($url),
                'isConnected' => UserController::isConnected(),
                'menu' => $this->getMenu(),
            ]);
        } else if(User::emailAlreadyUsed($email)){
            return view('inscription', [
                'error' => 'Cette adresse mail est déjà reliée à un compte',
                'currentPage' => $this->getCurrentPage($url),
                'isConnected' => UserController::isConnected(),
                'menu' => $this->getMenu(),
            ]);
        } else {
            User::createUser($pseudo ,$email, $password);
            return redirect()->intended('connexion');
        }
    }

    public static function getUserPhoto($userId){
        return User::getUserPhoto($userId);
    }
}
