<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Utilisateurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->string("pseudo", 100)->primary();
            $table->string("mail", 255);
            $table->string("mot_de_passe", 100);
            $table->boolean("est_bloque")->default(false);
            $table->integer("photo_profil")->default(0);
            $table->boolean("est_administrateur")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
