<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    use HasFactory;

    protected $connection = 'bd_chevaucheurs';
    protected $table = 'utilisateurs';
    protected $primaryKey = 'pseudo';

    public static function isAdministrateur($user){
        $isAdmin=self::select('est_administrateur')
            ->where('pseudo','=', $user)
            ->value();
        
        return $isAdmin;
    }
}
