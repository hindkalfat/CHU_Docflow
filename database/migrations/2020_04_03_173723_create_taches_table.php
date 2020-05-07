s<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->increments('idT');
            $table->string('Etat_avcT')->nullable();
            $table->date('date_echeanceT');
            $table->date('date_rappelT');
            $table->unsignedInteger('t_idA');
            $table->timestamps();
            
            //FK
            $table->foreign('t_idA')->references('idA')->on('actions')->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tache');
    }
}
