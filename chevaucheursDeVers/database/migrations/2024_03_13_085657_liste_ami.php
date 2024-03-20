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
            $table->unsignedBigInteger("id1");
            $table->unsignedBigInteger("id2");
    
            $table->foreign("id1")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("id2")->references("id")->on("users")->onDelete("cascade");
    
            $table->primary(["id1", "id2"]);
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
