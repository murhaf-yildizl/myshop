<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
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

Route::get('getcategories',['App\Http\Controllers\Api\CategoryController','index']);
Route::get('getcategories/{id}',['App\Http\Controllers\Api\CategoryController','get_cat']);

Route::get('gettags',['App\Http\Controllers\Api\TagController','index']);
Route::get('gettags/{id}',['App\Http\Controllers\Api\TagController','get_tag']);

Route::get('getproducts',['App\Http\Controllers\Api\ProductController','index']);
Route::get('getproducts/{id}',['App\Http\Controllers\Api\ProductController','get_product']);

Route::get('getcountries',['App\Http\Controllers\Api\CountryController','index']);
Route::get('getcountries/{id}/states',['App\Http\Controllers\Api\CountryController','get_states']);
Route::get('getcountries/{id}/cities',['App\Http\Controllers\Api\CountryController','get_cities']);

Route::get('getusers',['App\Http\Controllers\Api\UserController','index']);

Route::post('auth/register',['App\Http\Controllers\Api\AuthController','register']);
Route::post('auth/login',['App\Http\Controllers\Api\AuthController','login']);

Route::group(['auth:api'] ,function() {


});
