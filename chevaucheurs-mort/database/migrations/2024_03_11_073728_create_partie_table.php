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
            $table->string("gagnant", 100)->nullable();


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
