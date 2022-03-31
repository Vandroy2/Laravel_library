<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class Add4ColumnsToSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribes', function (Blueprint $table) {

            $table->string('subscribe_alias')->after('id');
            $table->date('dateStart')->default(Carbon::now())->after('monthQuantity');
            $table->date('dateEnd')->default(Carbon::now()->addMonth())->after('dateStart');
            $table->integer('canceled')->default(0)->after('dateEnd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribes', function (Blueprint $table) {

            $table->dropColumn('alias');
            $table->dropColumn('dateStart');
            $table->dropColumn('dateEnd');
            $table->dropColumn('canceled');

        });
    }
}
