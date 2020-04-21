<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->increments('idRU');
            $table->unsignedInteger('_idR');
            $table->unsignedInteger('_idU');
            $table->timestamps();
            
            //FK
            $table->foreign('_idU')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('_idR')->references('idR')->on('roles')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
}
