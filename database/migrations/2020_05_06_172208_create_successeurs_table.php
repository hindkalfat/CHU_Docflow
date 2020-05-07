<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuccesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('successeurs', function (Blueprint $table) {
            $table->increments('idS');
            $table->unsignedInteger('_idFrom')->nullable();
            $table->unsignedInteger('_idTo')->nullable();
            $table->timestamps();

            //FK
            $table->foreign('_idFrom')->references('idA')->on('actions')->onDelete('cascade');;
            $table->foreign('_idTo')->references('idA')->on('actions')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('successeurs');
    }
}
