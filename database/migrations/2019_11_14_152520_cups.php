<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cups', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('coffee_ordered')->nullable();
            $table->date('created_at');
            $table->unsignedBigInteger('owner');

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
        Schema::table('cups', function (Blueprint $table){
            $table->dropForeign('cups_owner_foreign');
        });
        Schema::dropIfExists('cups');
    }
}