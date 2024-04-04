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
            ['id1'=>'1', 'id2'=>'3', 'est_accepte'=>true, 'id_demandeur'=>'1'],
            ['id1'=>'2', 'id2'=>'3', 'est_accepte'=>false, 'id_demandeur'=>'3'],
            ['id1'=>'1', 'id2'=>'2', 'est_accepte'=>false, 'id_demandeur'=>'2'],

            ['id1'=>'1', 'id2'=>'9', 'est_accepte'=>true, 'id_demandeur'=>'9'],
            ['id1'=>'4', 'id2'=>'5', 'est_accepte'=>false, 'id_demandeur'=>'4'],
            ['id1'=>'4', 'id2'=>'8', 'est_accepte'=>true, 'id_demandeur'=>'8'],
            ['id1'=>'1', 'id2'=>'12', 'est_accepte'=>true, 'id_demandeur'=>'1'],
            ['id1'=>'1', 'id2'=>'7', 'est_accepte'=>false, 'id_demandeur'=>'7'],
            ['id1'=>'6', 'id2'=>'2', 'est_accepte'=>false, 'id_demandeur'=>'2'],
            ['id1'=>'6', 'id2'=>'9', 'est_accepte'=>true, 'id_demandeur'=>'9'],
            ['id1'=>'7', 'id2'=>'4', 'est_accepte'=>true, 'id_demandeur'=>'7'],
            ['id1'=>'12', 'id2'=>'2', 'est_accepte'=>false, 'id_demandeur'=>'12']

        ]);
    }
}
