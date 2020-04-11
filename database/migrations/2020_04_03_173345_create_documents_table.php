<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('idD');
            $table->string('nomD');
            $table->string('titreD');
            $table->string('etatD');
            $table->unsignedInteger('d_idU');
            $table->unsignedInteger('d_idTd');
            $table->timestamps();

            //FK
            $table->foreign('d_idU')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('d_idTd')->references('idTd')->on('types_doc')->onDelete('cascade');;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
