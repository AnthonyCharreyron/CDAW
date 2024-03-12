<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{
    public static function getMenu($isAdmin){
        $menuAppli = self::select('id_menu', 'menu_libelle', 'route')
                ->whereIn('pour_admin', array(0, $isAdmin))
                ->orderBy('no_ordre')
                ->get();
        $menu=array();
        foreach ($menuAppli as $key => $value) {
            $menu[] = array('id_menu'=> $value['id_menu'], 'menu_libelle' => $value['menu_libelle'],
                                'route' => $value['route']);
        }
        return $menu;
    }
}