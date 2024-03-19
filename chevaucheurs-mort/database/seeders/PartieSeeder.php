<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PartieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        //Etape 1
        DB::table('partie')->insert([
            ['id_partie'=>1, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>1, 'est_terminee'=>1, 'gagnant'=>'Fifi'],
            ['id_partie'=>2, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>1, 'est_commencee'=>1, 'est_terminee'=>0, 'gagnant'=>null],
            ['id_partie'=>3, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>0, 'est_terminee'=>0, 'gagnant'=>null]
        ]);

        //Etape 2
        //\App\Models\Partie::factory(10)->create();
    }
}
