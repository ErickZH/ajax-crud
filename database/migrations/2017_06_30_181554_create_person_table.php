<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema de persona
        Schema::create('person', function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('edad');
            $table->string('email');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Si existe la tabla la elimina
        Schema::dropIfExists('person');
    }
}
