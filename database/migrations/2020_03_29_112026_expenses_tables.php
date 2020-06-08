<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpensesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('expenses_daily_list', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->decimal('payment', 8, 2);
        //     $table->timestamps();
        //     $table->unsignedSmallInteger('expense_id');
        //     $table->unsignedInteger('user_id');

        //     $table->foreign('expense_id')->references('id')->on('expenses_categories');
        //     $table->foreign('user_id')->references('id')->on('users');
        // });

        // Schema::create('expenses_categories', function (Blueprint $table) {
        //     $table->smallIncrements('id');
        //     $table->string('name');
        //     $table->decimal('default_payment', 8, 2);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_daily_list');
        Schema::dropIfExists('expenses_categories');
    }
}
