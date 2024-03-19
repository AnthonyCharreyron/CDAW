<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListeAmi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liste_ami', function (Blueprint $table) {
            $table->string("pseudo1", 100);
            $table->foreign("pseudo1")->references("pseudo")->on("utilisateurs");

            $table->string("pseudo2", 100);
            $table->foreign("pseudo2")->references("pseudo")->on("utilisateurs");

            $table->primary(["pseudo1", "pseudo2"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liste_ami');
    }
}
