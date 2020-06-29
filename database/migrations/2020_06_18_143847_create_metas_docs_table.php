<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas_docs', function (Blueprint $table) {
            $table->increments('idMD');
            $table->unsignedInteger('_idM');
            $table->unsignedInteger('_idD');
            $table->unsignedInteger('_idUT')->nullable();
            $table->string('valeur');
            $table->timestamps();

            //FK
            $table->foreign('_idM')->references('idM')->on('metadonnees')->onDelete('cascade');;
            $table->foreign('_idD')->references('idD')->on('documents')->onDelete('cascade');;
            $table->foreign('_idUT')->references('idUT')->on('users_taches')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metas_docs');
    }
}
