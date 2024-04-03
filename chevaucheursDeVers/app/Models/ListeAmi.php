<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeAmi extends Model
{
    use HasFactory;

    protected $table = 'liste_ami';

    public static function getListeAmis($user) {
        return self::select('users.id', 'users.pseudo', 'users.photo_profil')
                    ->leftJoin('users', function($join) use ($user) {
                        $join->on('users.id', '=', \DB::raw(($user->id == 'liste_ami.id1') ? 'liste_ami.id1' : 'liste_ami.id2'));
                    })
                    ->where('id1', '=', $user->id)
                    ->orWhere('id2', '=', $user->id)
                    ->where('est_accepte', '=', 1)
                    ->get();
    }

    public static function getDemandePourMoi($user){
        return self::select('users.id', 'users.pseudo', 'users.photo_profil')
                    ->leftJoin('users', function($join) use ($user) {
                        $join->on('users.id', '=', \DB::raw(($user->id == 'liste_ami.id1') ? 'liste_ami.id1' : 'liste_ami.id2'));
                    })
                    ->where(function ($query) use ($user) {
                        $query->where('id1', $user->id)
                              ->orWhere('id2', $user->id);
                    })
                    ->where('est_accepte', 0)
                    ->where('id_demandeur', '!=', $user->id)
                    ->get();
    }
}
