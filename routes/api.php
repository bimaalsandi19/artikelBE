<?php

use App\Http\Controllers\PostController;
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

Route::get('post', [PostController::class, 'index']);
Route::get('post/{id}', [PostController::class, 'show']);
Route::post('add', [PostController::class, 'create']);
Route::get('page', [PostController::class, 'store']);
Route::get('page_publish', [PostController::class, 'store_publish']);
Route::get('page_draft', [PostController::class, 'store_draft']);
Route::get('page_trash', [PostController::class, 'store_trash']);
Route::put('update/{id}', [PostController::class, 'update']);
Route::delete('delete/{id}', [PostController::class, 'destroy']);
