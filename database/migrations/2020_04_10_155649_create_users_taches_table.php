<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_taches', function (Blueprint $table) {
            $table->increments('idUT');
            $table->unsignedInteger('_idT');
            $table->unsignedInteger('_idU');
            $table->unsignedInteger('_idV')->nullable();
            $table->timestamps();
            
            //FK
            $table->foreign('_idU')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('_idT')->references('idT')->on('taches')->onDelete('cascade');;
            $table->foreign('_idV')->references('idV')->on('versions')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_taches');
    }
}
