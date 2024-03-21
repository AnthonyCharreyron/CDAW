<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller{

    //TODO : faire le identification helper et le cas non identifié getMenu;
    public function getMenu(){
        $user = Auth::user();
        $pseudo = $user==null ? 'Anonymous' : $user->pseudo;

        Log::info($user);
        Log::info($pseudo);

        $isAdmin = User::isAdministrateur($pseudo); //TODO
        //Log::info($isAdmin);
        $menu=Menu::getMenu($isAdmin);
        //Log::info($menu);

        return $menu;
    }

    public function getCurrentPage($url){
        $currentPage = Menu::getCurrentPage($url);
        return $currentPage;
    }

}