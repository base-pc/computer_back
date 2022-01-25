<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CartController;


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
    Route::post('register',           [ AuthController::class, 'register']);
    Route::post('login',              [ AuthController::class, 'login']);
});

Route::post('provider/callback',   [ SocialController::class, 'handleProviderCallback']);

Route::get('product/all',                 [ ProductController::class, 'index']);
Route::get('product/hot',                 [ ProductController::class, 'hot']);
Route::get('product/show/{product_id}',   [ ProductController::class, 'show']);
Route::post('product/search',             [ ProductController::class, 'search']);

Route::get('category/all',                [ CategoryController::class, 'index']);
Route::get('category/show/{category_id}', [ CategoryController::class, 'show']);



Route::middleware(['is_admin'])->group(function () {

    Route::post('product/store/category/{category_id}', [ ProductController::class, 'store']);
    Route::delete('product/{product_id}/destroy',       [ ProductController::class, 'destroy']);
    Route::put('product/{product_id}/update',          [ ProductController::class, 'update']);

    Route::post('category/store',                       [ CategoryController::class, 'store']);
    Route::delete('category/{category_id}/destroy',     [ CategoryController::class, 'destroy']);
});

Route::middleware(['is_user'])->group(function () {

    Route::post('product/comment/{product_id}/store', [ CommentController::class, 'store'])
        ->middleware('has_commented');

    Route::post('product/rate/{product_id}',    [ RateController::class, 'store'])
        ->middleware('has_rated');

    Route::get('product/{product_id}/myrate',   [ RateController::class, 'showMyRate']);

    Route::post('cart/{product_id}/store', [ CartController::class, 'cartStore']);
    Route::get('cart/get',                 [ CartController::class, 'getCart']);
    Route::get('cart/total',               [ CartController::class, 'getTotal']);

});
