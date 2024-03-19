<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilisateurs')->insert([
            ['pseudo'=>'Tom', 'mail'=>'tom@free.fr', 'mot_de_passe'=>'tom', 'est_bloque'=>0, 'photo_profil'=>0, 'est_administrateur'=>0],
            ['pseudo'=>'Riri', 'mail'=>'riri@free.fr', 'mot_de_passe'=>'riri', 'est_bloque'=>1, 'photo_profil'=>1, 'est_administrateur'=>0],
            ['pseudo'=>'Fifi', 'mail'=>'fifi@free.fr', 'mot_de_passe'=>'fifi', 'est_bloque'=>0, 'photo_profil'=>0, 'est_administrateur'=>1]
        ]);
    }
}
