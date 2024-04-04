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
            ['id_partie'=>1, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>1, 'est_terminee'=>1, 'id_user_gagnant'=>3, 'nombre_joueurs'=>3, 'temps_par_coup'=>'00:01:00', 'id_user_host'=>1],
            ['id_partie'=>2, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>1, 'est_commencee'=>1, 'est_terminee'=>1, 'id_user_gagnant'=>2, 'nombre_joueurs'=>2, 'temps_par_coup'=>'00:00:30', 'id_user_host'=>1],
            ['id_partie'=>3, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>0, 'est_terminee'=>0, 'id_user_gagnant'=>null, 'nombre_joueurs'=>4, 'temps_par_coup'=>'00:01:00', 'id_user_host'=>2],
            ['id_partie'=>4, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>0, 'est_terminee'=>0, 'id_user_gagnant'=>null, 'nombre_joueurs'=>2, 'temps_par_coup'=>'00:00:30', 'id_user_host'=>2],
            ['id_partie'=>5, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>1, 'est_commencee'=>1, 'est_terminee'=>1, 'id_user_gagnant'=>5, 'nombre_joueurs'=>5, 'temps_par_coup'=>'00:02:00', 'id_user_host'=>5],
            ['id_partie'=>6, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>1, 'est_commencee'=>1, 'est_terminee'=>1, 'id_user_gagnant'=>5, 'nombre_joueurs'=>3, 'temps_par_coup'=>'00:01:00', 'id_user_host'=>5],
            ['id_partie'=>7, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>0, 'est_terminee'=>0, 'id_user_gagnant'=>null, 'nombre_joueurs'=>3, 'temps_par_coup'=>'00:02:00', 'id_user_host'=>6],
            ['id_partie'=>8, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>1, 'est_commencee'=>1, 'est_terminee'=>1, 'id_user_gagnant'=>7, 'nombre_joueurs'=>4, 'temps_par_coup'=>'00:05:00', 'id_user_host'=>7],
            ['id_partie'=>9, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>1, 'est_terminee'=>0, 'id_user_gagnant'=>null, 'nombre_joueurs'=>3, 'temps_par_coup'=>'00:05:00', 'id_user_host'=>9],
            ['id_partie'=>10, 'date_partie'=>$dateNow, 'code'=> Str::random(10), 'partie_privee'=>0, 'est_commencee'=>0, 'est_terminee'=>0, 'id_user_gagnant'=>null, 'nombre_joueurs'=>2, 'temps_par_coup'=>'00:00:30', 'id_user_host'=>10],


        ]);

        //Etape 2
        //\App\Models\Partie::factory(10)->create();
    }
}
