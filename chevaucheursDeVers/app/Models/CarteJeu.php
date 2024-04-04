<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CarteJeu extends Model
{
    use HasFactory;

    protected $table = 'carte_jeu';

    public static function droitZone($user, $idZone, $zonesPrises) {
        if (!array_key_exists($idZone, $zonesPrises)) {
            $infoChemin = self::infoChemin($idZone)->first();
            $cartesEnMain = session()->get('cartesEnMain_'.$user->id);
            $occurrences = array_count_values($cartesEnMain);
    
            if (isset($occurrences['Carte ver multicolore'])) {
                $occurrenceMulticolore = $occurrences['Carte ver multicolore'];
                unset($occurrences['Carte ver multicolore']);
            } else {
                $occurrenceMulticolore = 0;
            }
    
            foreach ($occurrences as $carte => $occurrence) {
                if ($infoChemin->couleur == 'noir') {
                    if ($infoChemin->nombre_de_pas <= $occurrence) {
                        self::retirerCarteEnMain($carte, $infoChemin->nombre_de_pas, $user);
                        self::ajouterZonePrise($user, $idZone, $zonesPrises);
                        return true;
                    }
                } elseif (strpos($carte, $infoChemin->couleur) !== false) {
                    if ($infoChemin->nombre_de_pas <= $occurrence) {
                        self::retirerCarteEnMain($carte, $infoChemin->nombre_de_pas, $user);
                        self::ajouterZonePrise($user, $idZone, $zonesPrises);
                        return true;
                    }
                }
            }
    
            foreach ($occurrences as $carte => $occurrence) {
                if ($infoChemin->couleur == 'noir') {
                    if ($infoChemin->nombre_de_pas <= $occurrence + $occurrenceMulticolore) {
                        self::retirerCarteEnMainAvecMulticolore($carte, $infoChemin->nombre_de_pas, $occurrence, $user);
                        self::ajouterZonePrise($user, $idZone, $zonesPrises);
                        return true;
                    }
                } elseif (strpos($carte, $infoChemin->couleur) !== false) {
                    if ($infoChemin->nombre_de_pas <= $occurrence + $occurrenceMulticolore) {
                        self::retirerCarteEnMainAvecMulticolore($carte, $infoChemin->nombre_de_pas, $occurrence, $user);
                        self::ajouterZonePrise($user, $idZone, $zonesPrises);
                        return true;
                    }
                }
            }
    
            return false;
        } else {
            return false;
        }
    }
    
    public static function infoChemin($idZone) {
        return self::select('nombre_de_pas', 'couleur', 'score')
                    ->where('id_chemin', '=', $idZone)
                    ->get();
    }
    
    public static function retirerCarteEnMain($carte, $nbrPas, $user) {
        $cartesEnMain = session()->get('cartesEnMain_'.$user->id);
        for ($i = 0; $i < $nbrPas; $i++) {
            $index = array_search($carte, $cartesEnMain);
            array_splice($cartesEnMain, $index, 1);
        }
        session(['cartesEnMain_'.$user->id => $cartesEnMain]);
    }
    
    public static function retirerCarteEnMainAvecMulticolore($carte, $nbrPas, $occurence, $user) {
        $cartesEnMain = session()->get('cartesEnMain_'.$user->id);
        for ($i = 0; $i < $occurence; $i++) {
            $index = array_search($carte, $cartesEnMain);
            array_splice($cartesEnMain, $index, 1);
        }
        for ($i = 0; $i < ($nbrPas - $occurence); $i++) {
            $index = array_search('Carte ver multicolore', $cartesEnMain);
            array_splice($cartesEnMain, $index, 1);
        }
        session(['cartesEnMain_'.$user->id => $cartesEnMain]);
    }
    
    public static function ajouterZonePrise($user, $idZone, $zonesPrises) {
        $zonesPrises[$idZone] = $user->pseudo;
        session(['zonesPrises' => $zonesPrises]);
    }
}