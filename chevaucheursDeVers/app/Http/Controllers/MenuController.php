<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Utilisateurs;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller{

    //TODO : faire le identification helper et le cas non identifié getMenu;
    public function getMenu(){
        Session::put("PSEUDO", "Riri");
        $user = session("PSEUDO");
        $isAdmin = Utilisateurs::isAdministrateur($user); //TODO
        //Log::info($isAdmin);
        $menu=Menu::getMenu($isAdmin);
        //Log::info($menu);

        return $menu;
    }

}