<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'pseudo' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'mot_de_passe' => Hash::make('password'),
            'est_administrateur' => true,
            'est_bloque' => false,
            'photo_profil' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'pseudo' => 'utilisateur' . $i,
                'email' => 'user' . $i . '@example.com',
                'email_verified_at' => now(),
                'mot_de_passe' => Hash::make('password'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
