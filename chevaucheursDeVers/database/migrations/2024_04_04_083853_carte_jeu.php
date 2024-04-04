<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarteJeu extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carte_jeu', function (Blueprint $table) {
            $table->integer('id_chemin')->autoIncrement();
            $table->string('Ville1');
            $table->string('Ville2');
            $table->integer('nombre_de_pas');
            $table->string('couleur');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('carte_jeu');
    }
};
