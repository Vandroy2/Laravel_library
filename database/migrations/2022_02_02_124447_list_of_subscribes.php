<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListOfSubscribes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listOfSubscribes', function (Blueprint $table) {

            $table->id();
            $table->string('alias');
            $table->string('listSubscribeType');
            $table->integer('listSubscribePrice');
            $table->integer('listSubscribeMonthQuantity');
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
        Schema::dropIfExists('listOfSubscribes');
    }
}
