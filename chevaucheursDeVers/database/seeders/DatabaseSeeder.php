<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UtilisateurSeeder::class,
            PartieSeeder::class,
            JoueSeeder::class,
            ListAmiSeeder::class,
            MenuSeeder::class
        ]);
    }
}
