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

            $table->unsignedBigInteger("id");
            $table->foreign("id")->references("id")->on("users");

            $table->integer("score");

            $table->primary(["id_partie", "id"]);

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
