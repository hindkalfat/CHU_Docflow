<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->increments('idWf');
            $table->string('nomWf');
            $table->text('descriptionWf')->nullable();
            $table->unsignedInteger('w_idTd')->index();
            $table->timestamps();

            //FK
            $table->foreign('w_idTd')->references('idTd')->on('types_doc')->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workflow');
    }
}
