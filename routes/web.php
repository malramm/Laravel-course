<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*    
Route::get('/', function () {
    return view('newInvoice');
    try {
        DB::connection()->getPdo();
        echo 'Yey, it worked';
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. error:" . $e );
    }
});
*/

Route::get('/', 'InvoiceController@newInvoice');

Route::get('editInvoice/{id}', 'InvoiceController@editInvoice');

Route::get('showInvoice/{id}', 'InvoiceController@showInvoice');

Route::get('listInvoices', 'InvoiceController@listInvoices');

Route::post('insertInvoice', 'InvoiceController@insertInvoice');

Route::post('updateInvoice/{id}', 'InvoiceController@updateInvoice');

Route::resource('products', 'ProductController');

