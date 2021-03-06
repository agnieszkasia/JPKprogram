<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CompanyTaxInformationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\TaxSettlementController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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

Route::group(['middleware' => ['guest']], function (){
    Route::get('/', function () { return view('welcome');})->name('welcome');
});

Auth::routes();

Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');



Route::group(['middleware' => ['auth']], function (){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /* company information routes */
    Route::get('/companyinformation/add', [CompanyTaxInformationController::class, 'create']);
    Route::post('/companyinformation/store', [CompanyTaxInformationController::class, 'store'])->name('store_company_tax_information');
    Route::get('/companyinformation/{id}/edit', [CompanyTaxInformationController::class, 'edit']);
    Route::post('/companyinformation/{id}/update', [CompanyTaxInformationController::class, 'update']);

    /* profile routes */
    Route::get('/profile', [UserController::class, 'show'])->name('profile');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit']);
    Route::post('/profile/{id}/update', [UserController::class, 'update']);
    Route::get('/profile/{id}/editpassword', [UserController::class, 'editPassword']);
    Route::post('/profile/{id}/updatepassword', [UserController::class, 'updatePassword']);

    /* invoices routes */
    Route::get('/invoices', [InvoiceController::class, 'showAll'])->name('invoices');
    Route::post('/invoices', [InvoiceController::class, 'showALl'])->name('search_invoices');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('create_invoice');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('store_invoice');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show']);
    Route::get('/invoice/{id}/pdf', [InvoiceController::class, 'generate_pdf']);
    Route::post('/invoice/{id}/delete', [InvoiceController::class, 'destroy'])->name('delete_invoices');
    Route::get('/invoice/{id}/edit', [InvoiceController::class, 'edit']);
    Route::post('/invoice/{id}/update', [InvoiceController::class, 'update']);

    /* purchase invoices routes*/
    Route::get('/purchaseinvoices', [PurchaseInvoiceController::class, 'showAll'])->name('purchase_invoices');
    Route::post('/purchaseinvoices', [PurchaseInvoiceController::class, 'showAll'])->name('search_purchase_invoices');
    Route::get('/purchaseinvoice/create', [PurchaseInvoiceController::class, 'create'])->name('create_purchase_invoice');
    Route::post('/purchaseinvoice/store', [PurchaseInvoiceController::class, 'store'])->name('store_purchase_invoice');
    Route::get('/purchaseinvoice/{id}', [PurchaseInvoiceController::class, 'show']);
    Route::post('/purchaseinvoice/{id}/delete', [PurchaseInvoiceController::class, 'destroy']);
    Route::get('/purchaseinvoice/{id}/edit', [PurchaseInvoiceController::class, 'edit']);
    Route::post('/purchaseinvoice/{id}/update', [PurchaseInvoiceController::class, 'update']);

    /* tax settlements routes */
    Route::get('/settlements', [TaxSettlementController::class, 'showAllTaxSettlement'])->name('show_tax_settlements');
    Route::post('/settlements', [TaxSettlementController::class, 'showAllTaxSettlement'])->name('search_tax_settlements');
    Route::get('/settlement/create', [TaxSettlementController::class, 'create'])->name('create_tax_settlement');
    Route::post('/settlement/generate', [TaxSettlementController::class, 'generate'])->name('generate_tax_settlement');
    Route::post('/settlement/store', [TaxSettlementController::class, 'store'])->name('store_tax_settlement');
    Route::get('/settlement/{id}', [TaxSettlementController::class, 'show']);
    Route::post('/settlement/{id}/delete', [TaxSettlementController::class, 'destroy']);
    Route::get('/settlement/{id}/generateXML', [TaxSettlementController::class, 'generateXMLFile']);

    Route::get('/corrections/create', [TaxSettlementController::class, 'createCorrection'])->name('create_tax_correction');
    Route::post('/corrections/store', [TaxSettlementController::class, 'storeCorrection'])->name('store_tax_correction');

    /* products routes */
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::view('/product/create', 'products/create')->name('create_product');
    Route::post('/product/store', [ProductController::class, 'store'])->name('store_product');
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/product/{id}/delete', [ProductController::class, 'destroy']);
    Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
    Route::post('/product/{id}/update', [ProductController::class, 'update']);

});

Route::any('{query}',function() { return redirect('/'); })
    ->where('query', '.*');


