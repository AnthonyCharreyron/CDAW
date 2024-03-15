<?php

namespace App\Http\Controllers;

use App\Http\Models\Menu;
use App\Http\Models\Utilisateur;

class MenuController extends Controller{

    //TODO : faire le identification helper et le cas non identifié getMenu;
    function getMenu(){
        $user = session("PSEUDO");
        $isAdmin = Utilisateur::isAdministrateur($user); //TODO

        $menu=Menu::getMenu($isAdmin);
    }

}