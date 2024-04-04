<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteJeu extends Model
{
    use HasFactory;

    protected $table = 'carte_jeu';

    public static function droitZone($user, $idZone, $zonesPrises) {
        if (!array_key_exists($idZone, $zonesPrises)) {
            $infoChemin = self::infoChemin($idZone);
            $cartesEnMain = session()->get('cartesEnMain_'.$user->id);
            $occurrences = array_count_values($cartesEnMain);
    
            foreach ($occurrences as $carte => $occurrence) {
                $carteCouleur = self::extractColor($carte);
                if ($infoChemin->couleur == 'noir') {
                    if ($infoChemin->nombre_de_pas <= $occurrence) {
                        return true;
                    }
                } elseif ($carteCouleur == $infoChemin->couleur) {
                    if ($infoChemin->nombre_de_pas <= $occurrence) {
                        return true;
                    }
                }
            }
            return false;
        } else {
            return false;
        }
    }
    

    public static function infoChemin($idZone){
        return self::select('nombre_de_pas', 'couleur', 'score')
                    ->where('id_chemin', '=', $idZone)
                    ->get();
    }
}
