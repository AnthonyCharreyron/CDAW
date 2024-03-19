<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConnexionController extends MenuController
{
    public function getConnexion(){

        $url = request()->url();
        //Log::info($url);

        return view('connexion', [
            'currentPage' => $this->getCurrentPage($url),
            'menu' => $this->getMenu(),
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'pseudo' => ['required', 'pseudo'],
            'mot_de_passe' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('presentation');
        }
 
        return back()->withErrors([
            'pseudo' => "Probleme d'authentification",
        ]);
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
    
        return redirect('/');
    }
}
