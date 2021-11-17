<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('office_number');
            $table->foreignId('delivery_id')->nullable()->after('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('delivery_id')->references('id')->on('deliveries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->dropForeign('offices_city_id_foreign');
            $table->dropForeign('offices_delivery_id_foreign');
            $table->dropColumn('city_id');
            $table->dropColumn('delivery_id');

        });
    }
}
