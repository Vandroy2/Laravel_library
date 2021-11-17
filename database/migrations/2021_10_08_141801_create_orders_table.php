<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('book_id')->default(null);
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->unsignedBigInteger('ukrcity_id');
            $table->foreign('ukrcity_id')->references('id')->on('ukrcities')->onDelete('cascade');
            $table->unsignedBigInteger('office_id');
            $table->foreign('office_id')->references('id')->on('offices');
            $table->text('order_comment');
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
        Schema::dropIfExists('orders');
    }
}
