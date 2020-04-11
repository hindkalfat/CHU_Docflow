<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('idA');
            $table->string('nomA');
            $table->string('titreA');
            $table->text('directiveA');
            $table->integer('date_limiteA');
            $table->string('opt_limiteA');
            $table->integer('date_rappelA');
            $table->string('opt_rappelA');
            $table->string('prioriteA');
            $table->unsignedInteger('a_idW');
            $table->unsignedInteger('a_idG');
            $table->unsignedInteger('a_idU');
            $table->timestamps();

            //FK
            $table->foreign('a_idW')->references('idWf')->on('workflows')->onDelete('cascade');;
            $table->foreign('a_idG')->references('idG')->on('groupes')->onDelete('cascade');;
            $table->foreign('a_idU')->references('id')->on('users')->onDelete('cascade');;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action');
    }
}
