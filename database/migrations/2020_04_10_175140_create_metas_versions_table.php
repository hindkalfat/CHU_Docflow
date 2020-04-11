<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas_versions', function (Blueprint $table) {
            $table->increments('idMV');
            $table->unsignedInteger('_idM');
            $table->unsignedInteger('_idV');
            $table->string('valeur');
            $table->timestamps();

            //FK
            $table->foreign('_idM')->references('idM')->on('metadonnees')->onDelete('cascade');;
            $table->foreign('_idV')->references('idV')->on('versions')->onDelete('cascade');;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metas_versions');
    }
}
