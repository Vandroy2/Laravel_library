<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->string('favorite_book_name');
            $table->timestamps();

            $table->index('user_id', 'pul_user_index');
            $table->index('book_id', 'pul_book_index');

            $table->foreign('user_id', 'pul_user_fk')->references('id')->on('users');
            $table->foreign('book_id', 'pul_book_fk')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_user');
    }
}
