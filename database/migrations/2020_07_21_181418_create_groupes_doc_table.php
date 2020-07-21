<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupesDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupes_docs', function (Blueprint $table) {
            $table->increments('idGD');
            $table->unsignedInteger('_idD');
            $table->unsignedInteger('_idG');
            $table->timestamps();

            //FK
            $table->foreign('_idD')->references('idD')->on('documents')->onDelete('cascade');;
            $table->foreign('_idG')->references('idG')->on('groupes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupes_doc');
    }
}
