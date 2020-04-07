<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {        
            $table->string('serviceU')->nullable()->after('nomU');
            $table->string('centreU')->after('nomU');
            $table->string('professionU')->after('nomU');
            $table->string('adresseU')->nullable()->after('nomU');
            $table->string('emailPersoU')->unique()->after('nomU');
            $table->string('numTelU')->nullable()->after('nomU');
            $table->string('villeU')->after('nomU');
            $table->string('prenomU')->after('nomU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
