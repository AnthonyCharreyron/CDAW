<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    use HasFactory;

    public static function isAdministrateur($user){
        $isAdmin=self::select('pour_admin')
            ->where('pseudo','=', $user)
            ->value();
        
        return $isAdmin;
    }
}
