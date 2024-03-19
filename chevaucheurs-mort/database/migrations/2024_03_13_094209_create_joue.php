<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joue', function (Blueprint $table) {
            $table->integer('id_partie');
            $table->foreign("id_partie")->references("id_partie")->on("partie");

            $table->string("pseudo", 100);
            $table->foreign("pseudo")->references("pseudo")->on("utilisateurs");

            $table->integer("score");

            $table->primary(["id_partie", "pseudo"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joue');
    }
}
