<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

// language route
Route::get('/lang', [userController::class, 'language_change']);
// Authentication
Route::post('login', [authController::class, 'login']);
Route::post('registerdata', [authController::class, 'register']);
Route::match(['get',  'post'], 'weblogout', [authController::class, 'weblogout']);

Route::get('/login', function () {
    return view('login');
});
Route::get('/notifications', function () {
    return view('notification');
});
Route::get('/company', function () {
    return view('company    ');
});


Route::middleware('custom')->group(function () {
    Route::get('/setting', [authController::class, 'settingdata']);
    Route::post('updateSettings', [authController::class, 'updateSet']);
    Route::get('/', [userController::class, 'Dashboard']);
    Route::get('help', function () {
        return view('help');
    });
});
Route::get('/users', function () {
    return view('users');
});
Route::get('/addSite', function () {
    return view('addsites');
});

Route::get('email', function () {

    return view("emails.parent");
});
Route::get('register', function () {

    return view("register");
});
Route::get('chat', function () {

    return view("chat");
});
Route::get('requestInvoice', function () {

    return view("request_invoice");
});
Route::get('transaction', function () {

    return view("transaction");
});



Route::controller(CompanyController::class)->group(function () {
    Route::post('/addComapany', 'addCompany')->name('addCompany');
});
Route::controller(InvoiceController::class)->group(function () {
    Route::post('/siteadd', 'addSite')->name('addSite');
    Route::get('/requestInvoice', 'siteData')->name('siteData');
});
Route::post("addTransaction/{id}", [TransactionController::class, 'addTransaction'])->name('addTransaction');
