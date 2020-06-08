<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// stats
Route::group(['prefix' => 'stats'], function () {
    Route::get('products', 'StatsController@products');
    Route::get('sales', 'StatsController@sales');
    Route::get('purchases', 'StatsController@purchases');
    Route::get('chart', 'StatsController@chart');
});

Route::middleware(['auth', 'localeapi'])->group(function () {
    // users
    Route::apiResource('users', 'Users\UserController');
    Route::apiResource('groups', 'Users\GroupController');
    Route::apiResource('suppliers', 'Users\SupplierController');
    Route::apiResource('clients', 'Users\ClientController');

    // privileges
    Route::apiResource('privileges', 'Users\PrivilegesController');

    // store
    Route::apiResource('products', 'Store\ProductController');
    Route::apiResource('productscategories', 'Store\ProductCategoryController')->except('show');

    // purchases
    Route::apiResource('invoices', 'Purchases\InvoiceController')->except('update');
    Route::apiResource('purchases/details', 'Purchases\PurchaseInvoiceDetailController')->except('index', 'show', 'update');

    // Sales
    Route::apiResource('sales', 'Sales\InvoiceController')->except('update');
    Route::apiResource('sales/details', 'Sales\InvoiceDetailController')->except('index', 'show', 'update');
});
