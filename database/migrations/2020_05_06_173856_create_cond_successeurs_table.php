<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondSuccesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cond_successeurs', function (Blueprint $table) {
            $table->increments('idCS');
            $table->unsignedInteger('_idFrom')->nullable();
            $table->unsignedInteger('_idTo')->nullable();
            $table->timestamps();

            //FK
            $table->foreign('_idFrom')->references('idA')->on('actions')->onDelete('cascade');;
            $table->foreign('_idTo')->references('idC')->on('conditions')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cond_successeurs');
    }
}
