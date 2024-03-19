<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'pseudo';

    public static function isAdministrateur($user){
        $isAdmin = self::where('pseudo', $user)
                        ->value('est_administrateur');
        
        return $isAdmin;
    }
}
