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
                'photo_profil' => 3,
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
                'photo_profil' => 2,
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
                'photo_profil' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Paul',
                'email' => 'paul@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('paul'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Max',
                'email' => 'max@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('max'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Raoul',
                'email' => 'raoul@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('raoul'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Lou',
                'email' => 'lou@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('lou'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Jeanne',
                'email' => 'jeanne@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('jeanne'),
                'est_administrateur' => true,
                'est_bloque' => false,
                'photo_profil' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Denis',
                'email' => 'denis@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('denis'),
                'est_administrateur' => false,
                'est_bloque' => true,
                'photo_profil' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => '03/04 : Rapport de triche sur ce joueur'
            ],
            [
                'pseudo' => 'Atreides',
                'email' => 'atreides@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('atreides'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Freyen',
                'email' => 'freyen@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('freyen'),
                'est_administrateur' => true,
                'est_bloque' => true,
                'photo_profil' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
            [
                'pseudo' => 'Anne',
                'email' => 'anne@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('anne'),
                'est_administrateur' => false,
                'est_bloque' => false,
                'photo_profil' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'commentaires' => 'Aucun'
            ],
        ]);
    }
}
