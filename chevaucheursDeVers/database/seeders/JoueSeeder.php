<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JoueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('joue')->insert([
            ['id_partie'=>1, 'id'=>'1', 'score'=>'80'],
            ['id_partie'=>1, 'id'=>'2', 'score'=>'93'],
            ['id_partie'=>1, 'id'=>'3', 'score'=>'120']
        ]);
    }
}
