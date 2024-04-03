<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeAmi extends Model
{
    use HasFactory;

    protected $table = 'liste_ami';

    public static function getListeAmis($user) {
        return self::select('users.pseudo', 'liste_ami.est_accepte', 'liste_ami.id_demandeur')
                    ->leftJoin('users', function($join) use ($user) {
                        $join->on('users.id', '=', \DB::raw(($user->id == 'liste_ami.id1') ? 'liste_ami.id1' : 'liste_ami.id2'));
                    })
                    ->where('id1', '=', $user->id)
                    ->orWhere('id2', '=', $user->id)
                    ->get();
    }
    
}
