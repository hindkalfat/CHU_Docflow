<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentIDTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->unsignedInteger('t_idD')->nullable()->after('t_idA');

            //FK
            $table->foreign('t_idD')->references('idD')->on('documents')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taches', function (Blueprint $table) {
            //
        });
    }
}
