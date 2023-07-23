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


Route::post('/user/register',[UserController::class,'register']);
/**
 * Insert multiple Data List User
 */
Route::post('/user/insert',[UserController::class,'storeManyUser']);
Route::group(['middleware' => ['auth:sanctum']], function () {   
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
     * Get Data List User
     */
    Route::get('/users', [UserController::class, 'view']);
});


