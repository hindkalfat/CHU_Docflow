<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetadonneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadonnees', function (Blueprint $table) {
            $table->increments('idM');
            $table->string('libelleM');
            $table->string('typeM');
            $table->unsignedInteger('m_idTd');
            $table->timestamps();

            //Fk
            $table->foreign('m_idTd')->references('idTd')->on('types_doc')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metadonnees');
    }
}
