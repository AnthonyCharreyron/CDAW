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
            ['id1'=>'1', 'id2'=>'3'],
            ['id1'=>'2', 'id2'=>'3']
        ]);
    }
}
