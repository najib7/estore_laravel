<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchasesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('user_id');
            $table->string('payment_type');
            $table->string('payment_status');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('purchases_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedMediumInteger('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('invoice_id')->references('id')->on('purchases_invoices')->onDelete('cascade');
        });


        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone', 40);
            $table->string('email')->unique();
            $table->string('address');
        });


        Schema::create('purchases_invoices_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('payment_amount', 8, 2);
            $table->string('payment_literal');
            $table->string('bank_name');
            $table->string('check_number');
            $table->timestamps();
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('user_id');

            $table->foreign('invoice_id')->references('id')->on('invoice_invoices');
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
        Schema::dropIfExists('purchases_invoices');
        Schema::dropIfExists('purchases_details');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('purchases_invoices_receipts');
    }
}
