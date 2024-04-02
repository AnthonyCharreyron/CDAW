<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\User;


class ConnexionController extends MenuController
{
    public function getConnexion(){

        $url = request()->url();
        //Log::info($url);

        return view('connexion', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
        ]);
    }

    public function getInscription(){

        $url = request()->url();
        //Log::info($url);

        return view('inscription', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
        ]);
    }

       /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'pseudo' => ['required', 'string'],
            'password' => ['required'],
        ]);
        
        $user = User::findUser($request->pseudo);
        if ($user && $user->est_bloque) {
            return back()->withErrors([
                'pseudo' => 'Votre compte est bloqué. Veuillez contacter l\'administrateur.',
            ])->onlyInput('pseudo');
        }
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('presentation');
        }
 
        return back()->withErrors([
            'pseudo' => 'The provided credentials do not match our records.',
        ])->onlyInput('pseudo');
    }

    /**
    * Log the user out of the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('presentation');
    }
}
