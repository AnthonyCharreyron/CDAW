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
        $isConnected = $user==null ? false : true;

        $isAdmin = User::isAdministrateur($pseudo);

        $menu=Menu::getMenu($isAdmin, $isConnected);


        return $menu;
    }

    public function getCurrentPage($url){
        $currentPage = Menu::getCurrentPage($url);
        return $currentPage;
    }

}