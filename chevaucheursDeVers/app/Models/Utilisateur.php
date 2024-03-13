<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model{

    public static function isAdministrateur($user){
        $isAdmin=self::select('pour_admin')
            ->where('pseudo','=', $user)
            ->value();
        
        return $isAdmin;
    }
}