<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarteJeuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carte_jeu')->insert([
            ['id_chemin'=>1, 'Ville1'=>'Sihaya', 'Ville2'=>'Barrière', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>2, 'Ville1'=>'Barrière', 'Ville2'=>'Caladan', 'nombre_de_pas'=>4, 'couleur' =>'rose', 'score'=>7],
            ['id_chemin'=>3, 'Ville1'=>'Caladan', 'Ville2'=>'Observatoire', 'nombre_de_pas'=>6, 'couleur' =>'jaune', 'score'=>15],
            ['id_chemin'=>4, 'Ville1'=>'Caladan', 'Ville2'=>'Bassin Impérial', 'nombre_de_pas'=>3, 'couleur' =>'bleu', 'score'=>5],
            ['id_chemin'=>5, 'Ville1'=>'Observatoire', 'Ville2'=>'Sietch Tabr', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>6, 'Ville1'=>'Sietch Tabr', 'Ville2'=>'Carthag', 'nombre_de_pas'=>3, 'couleur' =>'bleu', 'score'=>5],
            ['id_chemin'=>7, 'Ville1'=>'Carthag', 'Ville2'=>'Base météorologique', 'nombre_de_pas'=>3, 'couleur' =>'noir', 'score'=>5],
            ['id_chemin'=>8, 'Ville1'=>'Observatoire', 'Ville2'=>'Carthag', 'nombre_de_pas'=>5, 'couleur' =>'rouge', 'score'=>11],
            ['id_chemin'=>9, 'Ville1'=>'Base météorologique', 'Ville2'=>'Grotte des oiseaux', 'nombre_de_pas'=>6, 'couleur' =>'rouge', 'score'=>15],
            ['id_chemin'=>10, 'Ville1'=>'Base météorologique', 'Ville2'=>'Mont idaho', 'nombre_de_pas'=>4, 'couleur' =>'noir', 'score'=>7],
            ['id_chemin'=>11, 'Ville1'=>'Base météorologique', 'Ville2'=>'Sietch Gara Kulon', 'nombre_de_pas'=>6, 'couleur' =>'rose', 'score'=>15],
            ['id_chemin'=>12, 'Ville1'=>'Mont idaho', 'Ville2'=>'Petit Erg', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>13, 'Ville1'=>'Grotte des oiseaux', 'Ville2'=>'Mont idaho', 'nombre_de_pas'=>4, 'couleur' =>'vert', 'score'=>7],
            ['id_chemin'=>14, 'Ville1'=>'Grotte des oiseaux', 'Ville2'=>'Territoire des vers', 'nombre_de_pas'=>3, 'couleur' =>'jaune', 'score'=>5],
            ['id_chemin'=>15, 'Ville1'=>'Territoire des vers', 'Ville2'=>'Petit Erg', 'nombre_de_pas'=>4, 'couleur' =>'rose', 'score'=>7],
            ['id_chemin'=>16, 'Ville1'=>'Petit Erg', 'Ville2'=>'Plaine funèbre', 'nombre_de_pas'=>3, 'couleur' =>'jaune', 'score'=>5],
            ['id_chemin'=>17, 'Ville1'=>'Kaintain', 'Ville2'=>'Petit Erg', 'nombre_de_pas'=>2, 'couleur' =>'jaune', 'score'=>3],
            ['id_chemin'=>18, 'Ville1'=>'Kaintain', 'Ville2'=>'Sietch Gara Kulon', 'nombre_de_pas'=>2, 'couleur' =>'bleu', 'score'=>3],
            ['id_chemin'=>19, 'Ville1'=>'Sietch Gara Kulon', 'Ville2'=>'Arrakeen', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>20, 'Ville1'=>'Territoire des vers', 'Ville2'=>'Terre du Sud', 'nombre_de_pas'=>6, 'couleur' =>'bleu', 'score'=>15],
            ['id_chemin'=>21, 'Ville1'=>'Plaine funèbre', 'Ville2'=>'Terre du Sud', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>22, 'Ville1'=>'Terre du Sud', 'Ville2'=>'Faux mur du Sud', 'nombre_de_pas'=>5, 'couleur' =>'vert', 'score'=>11],
            ['id_chemin'=>23, 'Ville1'=>'Faux mur du Sud', 'Ville2'=>'Montagne Chin', 'nombre_de_pas'=>3, 'couleur' =>'bleu', 'score'=>5],
            ['id_chemin'=>24, 'Ville1'=>'Faux mur du Sud', 'Ville2'=>'Sietch de Tuek', 'nombre_de_pas'=>5, 'couleur' =>'noir', 'score'=>11],
            ['id_chemin'=>25, 'Ville1'=>'Kaintain', 'Ville2'=>"Réserve d'épices", 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>26, 'Ville1'=>'Montagne Chin', 'Ville2'=>'Arsunt', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>27, 'Ville1'=>'Sietch de Tuek', 'Ville2'=>'Trou dans la pierre', 'nombre_de_pas'=>4, 'couleur' =>'bleu', 'score'=>7],
            ['id_chemin'=>28, 'Ville1'=>'Sihaya', 'Ville2'=>'Trou dans la pierre', 'nombre_de_pas'=>3, 'couleur' =>'vert', 'score'=>7],
            ['id_chemin'=>29, 'Ville1'=>'Trou dans la pierre', 'Ville2'=>'Tsimpo', 'nombre_de_pas'=>4, 'couleur' =>'rouge', 'score'=>7],
            ['id_chemin'=>30, 'Ville1'=>'Tsimpo', 'Ville2'=>'Barrière', 'nombre_de_pas'=>3, 'couleur' =>'noir', 'score'=>5],
            ['id_chemin'=>31, 'Ville1'=>'Tsimpo', 'Ville2'=>'Bassin Impérial', 'nombre_de_pas'=>2, 'couleur' =>'jaune', 'score'=>3],
            ['id_chemin'=>32, 'Ville1'=>'Bassin Impérial', 'Ville2'=>'Arrakeen', 'nombre_de_pas'=>5, 'couleur' =>'noir', 'score'=>11],
            ['id_chemin'=>33, 'Ville1'=>'Observatoire', 'Ville2'=>'Pole Nord', 'nombre_de_pas'=>2, 'couleur' =>'noir', 'score'=>3],
            ['id_chemin'=>34, 'Ville1'=>"Réserve d'épices", 'Ville2'=>'Montagne Chin', 'nombre_de_pas'=>4, 'couleur' =>'vert', 'score'=>7],
            ['id_chemin'=>35, 'Ville1'=>'Arsunt', 'Ville2'=>'Tsimpo', 'nombre_de_pas'=>4, 'couleur' =>'jaune', 'score'=>7],
            ['id_chemin'=>36, 'Ville1'=>'Arsunt', 'Ville2'=>'Sietch de Tuek', 'nombre_de_pas'=>3, 'couleur' =>'rose', 'score'=>5],
            ['id_chemin'=>37, 'Ville1'=>'Arsunt', 'Ville2'=>'Sietch de Tuek', 'nombre_de_pas'=>3, 'couleur' =>'vert', 'score'=>5],
            ['id_chemin'=>38, 'Ville1'=>'Plaine funèbre', 'Ville2'=>'Montagne Chin', 'nombre_de_pas'=>4, 'couleur' =>'rose', 'score'=>7],
            ['id_chemin'=>39, 'Ville1'=>'Plaine funèbre', 'Ville2'=>'Montagne Chin', 'nombre_de_pas'=>4, 'couleur' =>'rouge', 'score'=>7],
            ['id_chemin'=>40, 'Ville1'=>"Réserve d'épices", 'Ville2'=>'Bassin Impérial', 'nombre_de_pas'=>3, 'couleur' =>'rose', 'score'=>5],
            ['id_chemin'=>41, 'Ville1'=>"Réserve d'épices", 'Ville2'=>'Bassin Impérial', 'nombre_de_pas'=>3, 'couleur' =>'rouge', 'score'=>5],
            ['id_chemin'=>42, 'Ville1'=>'Arrakeen', 'Ville2'=>'Pole Nord', 'nombre_de_pas'=>2, 'couleur' =>'vert', 'score'=>3],
            ['id_chemin'=>43, 'Ville1'=>'Arrakeen', 'Ville2'=>'Pole Nord', 'nombre_de_pas'=>2, 'couleur' =>'bleu', 'score'=>3],


            
            

        ]);
    }
}
