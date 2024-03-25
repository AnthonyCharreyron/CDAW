<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partie', function (Blueprint $table) {
            $table->integer('id_partie')->autoIncrement();
            $table->date("date_partie");
            $table->string('code')->nullable();
            $table->boolean("partie_privee")->default(false);
            $table->boolean("est_commencee")->default(false);
            $table->boolean("est_terminee")->default(false);
            $table->unsignedBigInteger("id_user_gagnant")->nullable();
            $table->foreign("id_user_gagnant")->references("id")->on("users")->onDelete("cascade");
            $table->integer("nombre_joueurs")->default(2);
            $table->time("temps_par_coup")->default('00:01:00');
            $table->unsignedBigInteger("id_user_host");
            $table->foreign("id_user_host")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partie');
    }
}
