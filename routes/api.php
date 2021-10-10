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
Route::get('product/show/{id}',  [ ProductController::class, 'show']);
Route::post('product/search',    [ SearchController::class, 'search']);

Route::get('category/all',       [ CategoryController::class, 'index']);
Route::get('category/show/{id}', [ CategoryController::class, 'show']);



Route::middleware(['CheckAdmin', 'jwt.auth'])->group(function () {

    Route::get('product/my',                   [ ProductController::class, 'showMyProducts']);
    Route::post('product/store/category/{id}', [ ProductController::class, 'store']);
    Route::delete('product/{id}/destroy',      [ ProductController::class, 'destroy']);
    Route::post('product/{id}/update',         [ ProductController::class, 'update']);

    Route::post('category/store',              [ CategoryController::class, 'store']);
    Route::delete('category/{id}/destroy',     [ CategoryController::class, 'destroy']);
});

Route::middleware(['IsNotAdmin', 'jwt.auth'])->group(function () {

    Route::post('product/comment/{id}/store', [ CommentController::class, 'store']);

});

