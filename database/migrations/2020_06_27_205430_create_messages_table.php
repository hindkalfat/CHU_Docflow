<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('idM');
            $table->string('sujet')->nullable();
            $table->text('message');
            $table->integer('save')->default('0');
            $table->integer('delete')->default('0');
            $table->integer('from_id')->unsigned();
            $table->integer('to_id')->unsigned();

            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            //FK
            $table->foreign('from_id', 'from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_id', 'to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
