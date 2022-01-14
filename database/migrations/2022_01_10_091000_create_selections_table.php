<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */

    public function up()
    {
        Schema::create('selections', function (Blueprint $table) {
            $table->id();
            $table->string('selection_name');
            $table->string('sortByPrice')->nullable();
            $table->string('sortBySales')->nullable();
            $table->string('limit')->nullable();
            $table->integer('priceParamLow')->nullable();
            $table->integer('priceParamHigh')->nullable();
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
        Schema::dropIfExists('selections');
    }
}
