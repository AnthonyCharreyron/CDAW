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
            ['id_partie'=>1, 'pseudo'=>'Tom', 'score'=>'80'],
            ['id_partie'=>1, 'pseudo'=>'Riri', 'score'=>'93'],
            ['id_partie'=>1, 'pseudo'=>'Fifi', 'score'=>'120']
        ]);
    }
}
