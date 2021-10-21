<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;


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

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('register',           [ RegisterController::class, 'register']);
    Route::post('login',              [ LoginController::class, 'login']);
    Route::get('profile',             [ ProfileController::class, 'profile']);
});

Route::get('google',             [ GoogleController::class, 'redirectToGoogle']);
Route::get('google/callback',    [ GoogleController::class, 'handleGoogleCallback']);

Route::get('product/all',        [ ProductController::class, 'index']);
Route::get('product/show/{product_id}',  [ ProductController::class, 'show']);
Route::post('product/search',    [ ProductController::class, 'search']);

Route::get('category/all',       [ CategoryController::class, 'index']);
Route::get('category/show/{category_id}', [ CategoryController::class, 'show']);



Route::middleware(['CheckAdmin', 'jwt.auth'])->group(function () {

    Route::post('product/store/category/{category_id}', [ ProductController::class, 'store']);
    Route::delete('product/{product_id}/destroy',       [ ProductController::class, 'destroy']);
    Route::post('product/{product_id}/update',          [ ProductController::class, 'update']);

    Route::post('category/store',                       [ CategoryController::class, 'store']);
    Route::delete('category/{category_id}/destroy',     [ CategoryController::class, 'destroy']);
});

Route::middleware(['IsNotAdmin', 'jwt.auth'])->group(function () {

    Route::post('product/comment/{product_id}/store', [ CommentController::class, 'store']);

});

