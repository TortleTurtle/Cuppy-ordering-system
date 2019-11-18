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
            $table->bigIncrements('id');
            $table->boolean('clip');
            $table->boolean('engraving');
            $table->string('front_img');
            $table->string('back_img');
            $table->string('location');
            $table->dateTime('ordered_at');
            $table->dateTime('delivered_at');
            $table->unsignedBigInteger('cup_id');
            $table->unsignedBigInteger('owner');

            $table->foreign('cup_id')->references('id')->on('cups');
            $table->foreign('owner')->references('id')->on('users');
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
            $table->dropForeign('orders_cup_id_foreign');
            $table->dropForeign('orders_owner_foreign');
        });
        Schema::dropIfExists('orders');
    }
}
