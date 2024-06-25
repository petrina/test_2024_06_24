<?php

use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\BookStateController;
use App\Http\Controllers\API\CopyBookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('authors', AuthorController::class)->middleware('lib.admin');
    Route::resource('books', BookController::class)->middleware('lib.admin');
    Route::resource('copy_book', CopyBookController::class);

    Route::post('book_state/return', [BookStateController::class, 'returnCopyBookToLibrary']);
    Route::post('book_state/give', [BookStateController::class, 'giveBookToReader']);
});

