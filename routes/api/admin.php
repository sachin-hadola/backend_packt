<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for Admin
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for admin. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'admin'], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::resource('books', BookController::class, ['except' => ['index', 'create', 'edit']]);
        Route::post('books/list', [BookController::class, 'index']);
    });
    Route::get('logout', [AuthController::class, 'logout']);
});