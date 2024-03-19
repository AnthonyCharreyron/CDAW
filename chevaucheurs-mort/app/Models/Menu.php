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
        $menuAppli = self::select('menu_libelle', 'route', 'no_ordre')
                        ->whereIn('pour_admin', [0, $isAdmin])
                        ->orderBy('no_ordre')
                        ->get();

        $menu=[];
        foreach ($menuAppli as $key => $value) {
            $menu[] = [
                'menu_libelle' => $value->menu_libelle,
                'route' => $value->route,
                'no_ordre' => $value->no_ordre
            ];
        }
        
        //Log::info($menu);
        return $menu;
    }

    public static function getCurrentPage($url){
        $uri = parse_url($url, PHP_URL_PATH);
        $currentPage = self::whereIn('route', [$uri])
                            ->value('menu_libelle');
        //Log::info($currentPage);
        return $currentPage;
    }

}
