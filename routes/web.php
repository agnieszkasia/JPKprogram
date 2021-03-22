<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () { return view('welcome');})->name('welcome');


Auth::routes();

Route::group(['middleware' => ['auth']], function (){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/invoices', [InvoiceController::class, 'showAll'])->name('invoices');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('create_invoice');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('store_invoice');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show']);
    Route::get('/invoice/{id}/delete', [InvoiceController::class, 'destroy']);
    Route::get('/invoice/{id}/edit', [InvoiceController::class, 'edit']);
    Route::post('/invoice/{id}/update', [InvoiceController::class, 'update']);

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::view('/product/create', 'products/create')->name('create_product');
    Route::post('/product/store', [ProductController::class, 'store'])->name('store_product');
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/product/{id}/delete', [ProductController::class, 'destroy']);
    Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
    Route::post('/product/{id}/update', [ProductController::class, 'update']);

});

