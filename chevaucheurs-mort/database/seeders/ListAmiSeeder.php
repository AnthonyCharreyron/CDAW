<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListAmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('liste_ami')->insert([
            ['pseudo1'=>'Fifi', 'pseudo2'=>'Riri'],
            ['pseudo1'=>'Tom', 'pseudo2'=>'Riri']
        ]);
    }
}
