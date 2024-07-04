<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VoucherController;
use App\Models\Site;
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
// Route::get('/users', function () {
//     return view('users');
// });
Route::get('/users', [userController::class, 'users']);
Route::get('/deleteUser/{id}', [userController::class, 'deleteUser'])->name("deleteUser");
Route::get('/update-user/{id}', [userController::class, 'updateUser'])->name("updateUser");
// Route::get('/addSite', function () {
//     return view('addsites');
// });

Route::get('email', function () {

    return view("emails.parent");
});
Route::get('register', function () {

    return view("register");
});
Route::get('chat', function () {

    return view("chat");
});
Route::get('transaction', function () {

    return view("transaction");
});
Route::get('transactionVoucher', function () {

    return view("transaction_voucher");
});

Route::get('reports', function () {

    return view("reports");
});



Route::controller(CompanyController::class)->group(function () {
    Route::post('/addComapany', 'addCompany')->name('addCompany');
});
Route::controller(InvoiceController::class)->group(function () {
    Route::post('/request_invoice', 'addSite')->name('requestInvoice');
    Route::get('/requestInvoice', 'siteData')->name('siteData');
});
Route::controller(SiteController::class)->group(function () {
    Route::post('/addSites', 'siteAdd')->name('addSite');
    Route::get('/addSite', 'getSite')->name('getSite');
});
Route::post("addTransaction/{id}", [TransactionController::class, 'addTransaction'])->name('addTransaction');
Route::get("reports", [TransactionController::class, 'getData'])->name('getData');
Route::controller(VoucherController::class)->group(function () {
    Route::post("addVoucher", 'addVoucher')->name('addVoucher');
    Route::get("transactionVoucher", 'getUser')->name('getUser');
    Route::get("printVoucher/{id}", 'printVoucher')->name('printVoucher');
});

Route::get("getLedgerData", [ReportsController::class, 'getLedgerData']);

// delete all Transaction data
Route::match(["get", "post"], "deleteTransaction/{id}", [TransactionController::class, 'deleteTransaction']);
Route::get("transctionData/{id}", [TransactionController::class, 'transctionData']);

Route::post("/editVoucher/{id}", [TransactionController::class, 'editVoucher']);

Route::match(["get", "post"],  "/deleteInvoice/{id}", [TransactionController::class, 'deleteInvoice']);

Route::get("getInvoiceStatus/{id}", [InvoiceController::class, 'getInvoiceStatus']);
Route::get("getInvoiceTransData/{id}", [InvoiceController::class, 'getInvoiceTransData']);
Route::post("updateTransStatus/{id}", [InvoiceController::class, 'updateTransStatus']);
