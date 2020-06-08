<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('client_id');
            $table->unsignedInteger('user_id');
            $table->string('payment_type');
            $table->string('payment_status');
            $table->decimal('discount', 3, 2);
            $table->string('note')->nullable();
            $table->timestamps();


            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('sales_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedMediumInteger('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();


            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('invoice_id')->references('id')->on('sales_invoices')->onDelete('cascade');
        });


        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone', 40);
            $table->string('email')->unique();
            $table->string('address');
        });


        Schema::create('sales_invoices_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('payment_amount', 8, 2);
            $table->string('payment_literal');
            $table->string('bank_name');
            $table->string('check_number');
            $table->timestamps();
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('user_id');

            $table->foreign('invoice_id')->references('id')->on('sales_invoices');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_invoices');
        Schema::dropIfExists('sales_details');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('sales_invoices_receipts');
    }
}
