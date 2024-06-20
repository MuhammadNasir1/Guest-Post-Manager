<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\parentController;
use App\Http\Controllers\productController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\teachingController;
use App\Http\Controllers\trainingController;
use App\Http\Controllers\userController;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [authController::class, 'login']);
Route::post('register', [authController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [authController::class, 'logout']);
    Route::post('changepasword', [userController::class, 'changepasword']);
    Route::post('/updateSettings', [authController::class, 'updateSettings']);
    Route::get('/getUserProfile', [authController::class, 'getUserProfile']);
});


// category
Route::get('getCategories', [productController::class, 'getAllCategories']);


//  products
Route::get('getProducts', [productController::class, 'getAllProducts']);


// order
Route::post('Addorders', [ordersController::class, 'Addorders']);
Route::get('/orderHistory/{customer_id}', [ordersController::class, 'getorderHistory']);
Route::get('/orderHistoryDistributor/{user_id}', [ordersController::class, 'orderHistoryDistributor']);


// customer
Route::post('AddCustomer', [userController::class, 'addCustomer']);
Route::get('getCustomer', [userController::class, 'getCustomer']);
//  app graph data
Route::get('getGraphData', [userController::class, 'getGraphData']);
