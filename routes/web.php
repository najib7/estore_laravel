<?php

use App\Models\Sales\SaleInvoice;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false
]);

Route::middleware(['auth:web', 'locale'])->group(function () {
    // home page
    Route::get('/', 'HomeController@index')->name('home');

    // users
    // Route::view('users', 'users.index')->name('users');
    Route::get('users', 'Users\UserController@view')->name('users');
    Route::view('groups', 'groups.index')->name('groups');
    Route::view('clients', 'store.clients')->name('clients');
    Route::view('suppliers', 'store.suppliers')->name('suppliers');

    // store
    Route::view('products', 'products.index')->name('products');
    Route::view('products/categories', 'products.categories')->name('products_categories');

    // purchases
    Route::view('purchases', 'store.purchases')->name('purchases');

    // sales
    Route::view('sales', 'store.sales')->name('sales');


    // invoices
    Route::view('invoice', 'invoice.sale');

    Route::get('print/sale/{id}', 'Printcontroller@sale');
    Route::get('print/purchase/{id}', 'Printcontroller@purchase');
});


Route::get('switchlanguage/{lang}', 'SwitchLanguage@index')->where('lang', '[a-zA-Z]{2}')->name('switch');
