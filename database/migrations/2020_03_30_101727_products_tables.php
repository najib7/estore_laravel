<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->unsignedMediumInteger('quantity');
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('products_categories');
        });


        Schema::create('products_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('products');
        Schema::dropIfExists('products_categories');
    }
}
