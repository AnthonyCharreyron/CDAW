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

    public static function getMenu($isAdmin){
        $menuAppli = self::select('id_menu', 'menu_libelle', 'route')
                ->whereIn('pour_admin', array(0, $isAdmin))
                ->orderBy('no_ordre')
                ->get();
        $menu=array();
        foreach ($menuAppli as $key => $value) {
            $menu[] = array('id_menu'=> $value['id_menu'], 'menu_libelle' => $value['menu_libelle'], 'route' => $value['route']);
        }
        Log::info($menu);
        return $menu;
    }
}
