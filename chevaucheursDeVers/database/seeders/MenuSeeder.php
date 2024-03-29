<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            ['id_menu'=>'1', 'menu_libelle'=>'Présentation', 'route'=>'/presentation', 'pour_admin'=>0, 'no_ordre'=>1],
            ['id_menu'=>'2', 'menu_libelle'=>'Tableau des scores', 'route'=>'/historique', 'pour_admin'=>0, 'no_ordre'=>2],
            ['id_menu'=>'3', 'menu_libelle'=>'Jouer', 'route'=>'/jouer', 'pour_admin'=>0, 'no_ordre'=>3],
            ['id_menu'=>'5', 'menu_libelle'=>'Gestion des comptes', 'route'=>'/monitoring', 'pour_admin'=>1, 'no_ordre'=>4],
            ['id_menu'=>'4', 'menu_libelle'=>'Se connecter', 'route'=>'/connexion', 'pour_admin'=>0, 'no_ordre'=>5]
        ]);
    }
}
