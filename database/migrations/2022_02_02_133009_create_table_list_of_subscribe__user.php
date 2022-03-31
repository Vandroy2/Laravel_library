<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableListOfSubscribeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listOfSubscribe_user', function (Blueprint $table) {

            $table->id();

            $table->foreignId('listOfSubscribe_id');
            $table->foreignId('user_id');

            $table->foreign('listOfSubscribe_id')->references('id')->on('listOfSubscribes');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listOfSubscribe_user');
    }
}
