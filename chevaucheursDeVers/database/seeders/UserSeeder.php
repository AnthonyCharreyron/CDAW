<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



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
            [
                'pseudo' => 'Riri',
                'email' => 'riri@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('riri'),
                'est_administrateur' => true,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Fifi',
                'email' => 'fifi@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('fifi'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => '25/03 : Plaintes contre ce joueur, à suivre'
            ],
            [
                'pseudo' => 'Tom',
                'email' => 'tom@free.fr',
                'email_verified_at' => now(),
                'password' => Hash::make('test'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ]
        ]);
    }
}
