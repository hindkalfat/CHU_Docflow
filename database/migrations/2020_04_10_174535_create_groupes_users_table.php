<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupes_users', function (Blueprint $table) {
            $table->increments('idGU');
            $table->unsignedInteger('_idU');
            $table->unsignedInteger('_idG');
            $table->timestamps();

            //FK
            $table->foreign('_idU')->references('id')->on('users')->onDelete('cascade');;
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
        Schema::dropIfExists('groupes_users');
    }
}
