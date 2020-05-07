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
            $table->text('directiveA')->nullable();
            $table->integer('date_limiteA');
            $table->string('opt_limiteA');
            $table->integer('date_rappelA')->nullable();
            $table->string('opt_rappelA')->nullable();
            $table->string('prioriteA')->nullable();
            $table->string('typeA');
            $table->bigInteger('idop')->nullable();
            $table->integer('couranteA')->nullable();
            $table->integer('versionA')->nullable(); //accept version
            //email
            $table->string('destinataireIA')->nullable();
            $table->unsignedInteger('a_destinataireU')->nullable();
            $table->string('objetA')->nullable();
            $table->string('messageA')->nullable();

            $table->unsignedInteger('a_idW');
            $table->unsignedInteger('a_idG')->nullable();
            $table->unsignedInteger('a_idU')->nullable();
            $table->timestamps();

            //FK
            $table->foreign('a_idW')->references('idWf')->on('workflows')->onDelete('cascade');;
            $table->foreign('a_idG')->references('idG')->on('groupes')->onDelete('cascade');;
            $table->foreign('a_idU')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('a_destinataireU')->references('id')->on('users')->onDelete('cascade');;
            
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
