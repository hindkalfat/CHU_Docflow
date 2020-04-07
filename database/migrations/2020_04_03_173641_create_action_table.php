<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action', function (Blueprint $table) {
            $table->increments('idA');
            $table->string('nomA');
            $table->string('titreA');
            $table->text('directiveA');
            $table->integer('date_limiteA');
            $table->string('opt_limiteA');
            $table->integer('date_rappelA');
            $table->string('opt_rappelA');
            $table->string('prioriteA');
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
        Schema::dropIfExists('action');
    }
}
