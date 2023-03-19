<?php

use App\Http\Controllers\Frontend\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for Frontend
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for frontend. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('books', BookController::class, ['except' => ['index', 'create', 'edit']]);
Route::post('books/list', [BookController::class, 'index']);