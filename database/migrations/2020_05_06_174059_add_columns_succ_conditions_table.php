<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSuccConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conditions', function (Blueprint $table) {
            $table->unsignedInteger('_idAo')->nullable();
            $table->unsignedInteger('_idAn')->nullable();
            $table->unsignedInteger('_idCo')->nullable();
            $table->unsignedInteger('_idCn')->nullable();

            //FK
            $table->foreign('_idAo')->references('idA')->on('actions')->onDelete('cascade');;
            $table->foreign('_idAn')->references('idA')->on('actions')->onDelete('cascade');;
            $table->foreign('_idCo')->references('idC')->on('conditions')->onDelete('cascade');;
            $table->foreign('_idCn')->references('idC')->on('conditions')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conditions', function (Blueprint $table) {
            //
        });
    }
}
