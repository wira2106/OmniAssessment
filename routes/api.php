<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * menu Product Stock
 */
Route::get('/listProduct', [ProductController::class, 'listProduct']);
/**
 * menu list all user
 */
Route::get('/list_user', [UserController::class, 'list_user']);



/**
 * Get Data List User
 */
Route::get('/users', [UserController::class, 'view']);
/**
 * Store Data List User
 */
Route::post('/user/create',[UserController::class,'store']);
/**
 * Get Data User for edit
 */
Route::get('/user/edit/{id}',[UserController::class,'edit']);
/**
 * Update Data User 
 */
Route::post('/user/update/{id}',[UserController::class,'update']);
/**
 * Delete Data List User
 */
Route::delete('/user/delete/{id}',[UserController::class,'destroy']);


/**
 * Get Data List Company
 */
Route::get('/company', [CompanyController::class, 'view']);
/**
 * Get Data List Pegawai Company
 */
Route::get('/company/pegawai/{id}', [CompanyController::class, 'view_pegawai']);
/**
 * Store Data List User
 */
Route::post('/company/create',[CompanyController::class,'store']);
/**
 * Get Data company for detail
 */
Route::get('/company/detail/{id}',[CompanyController::class,'detail']);
/**
 * Update Data company 
 */
Route::post('/company/update/{id}',[CompanyController::class,'update']);
/**
 * Delete Data List company
 */
Route::delete('/company/delete/{id}',[CompanyController::class,'destroy']);

