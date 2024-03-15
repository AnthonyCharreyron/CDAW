<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Menu extends Model
{
    use HasFactory;

    protected $connection = 'bd_chevaucheurs';
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    //TODO : si on est identifié, le menu "se connecter" ne doit pas apparaitre & si on n'est pas connecté c'est "Jouer" qui n'apparait pas
    public static function getMenu($isAdmin){
        $menuAppli = self::select('menu_libelle', 'route')
                        ->whereIn('pour_admin', [0, $isAdmin])
                        ->orderBy('no_ordre')
                        ->get();

        $menu=[];
        foreach ($menuAppli as $key => $value) {
            $menu[] = [
                'menu_libelle' => $value->menu_libelle,
                'route' => $value->route
            ];
        }
        
        //Log::info($menu);
        return $menu;
    }

}
