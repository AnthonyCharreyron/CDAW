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
            ['id_partie'=>1, 'id_user'=>'1', 'score'=>'80'],
            ['id_partie'=>1, 'id_user'=>'2', 'score'=>'93'],
            ['id_partie'=>1, 'id_user'=>'3', 'score'=>'120'],

            ['id_partie'=>2, 'id_user'=>'2', 'score'=>'127'],
            ['id_partie'=>2, 'id_user'=>'1', 'score'=>'115'],

            ['id_partie'=>3, 'id_user'=>'2', 'score'=>null],
            ['id_partie'=>3, 'id_user'=>'8', 'score'=>null],

            ['id_partie'=>4, 'id_user'=>'2', 'score'=>null],
            ['id_partie'=>4, 'id_user'=>'10', 'score'=>null],

            ['id_partie'=>5, 'id_user'=>'5', 'score'=>110],
            ['id_partie'=>5, 'id_user'=>'10', 'score'=>60],
            ['id_partie'=>5, 'id_user'=>'11', 'score'=>79],
            ['id_partie'=>5, 'id_user'=>'12', 'score'=>103],
            ['id_partie'=>5, 'id_user'=>'6', 'score'=>80],

            ['id_partie'=>6, 'id_user'=>'5', 'score'=>125],
            ['id_partie'=>6, 'id_user'=>'1', 'score'=>115],
            ['id_partie'=>6, 'id_user'=>'4', 'score'=>83],

            ['id_partie'=>7, 'id_user'=>'6', 'score'=>null],
            ['id_partie'=>7, 'id_user'=>'9', 'score'=>null],

            ['id_partie'=>8, 'id_user'=>'7', 'score'=>108],
            ['id_partie'=>8, 'id_user'=>'8', 'score'=>90],
            ['id_partie'=>8, 'id_user'=>'9', 'score'=>86],
            ['id_partie'=>8, 'id_user'=>'10', 'score'=>73],

            ['id_partie'=>9, 'id_user'=>'9', 'score'=>null],
            ['id_partie'=>9, 'id_user'=>'3', 'score'=>null],
            ['id_partie'=>9, 'id_user'=>'5', 'score'=>null],
            
            ['id_partie'=>10, 'id_user'=>'10', 'score'=>null],








        ]);
    }
}
