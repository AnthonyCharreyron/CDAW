<?php

namespace App\Http\Controllers;

use App\Http\Models\Menu;
use App\Http\Models\Utilisateur;

class MenuController {

    function afficheMenu(){
        $user = session("PSEUDO");
        $isAdmin = Utilisateur::isAdministrateur($user); //TODO

        $menu=Menu::getMenu($isAdmin);

        return view('accueil', [
            'menu' => $menu;
        ]);

    }

}