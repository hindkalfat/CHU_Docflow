<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions_metas', function (Blueprint $table) {
            $table->increments('idAM');
            $table->unsignedInteger('_idA');
            $table->unsignedInteger('_idM');
            $table->timestamps();

            //FK
            $table->foreign('_idA')->references('idA')->on('actions')->onDelete('cascade');;
            $table->foreign('_idM')->references('idM')->on('metadonnees')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_metas');
    }
}
