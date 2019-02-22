<?php

use Illuminate\Http\Request;

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


Route::get('filter','Api\ProductController@search');


Route::get('product','Api\ProductController@index');
Route::post('product/store','Api\ProductController@store');
Route::get('product/edit/{slug}','Api\ProductController@edit');
Route::get('product/category','Api\ProductController@category');
Route::get('product/category/{slug}','Api\ProductController@byCategory');
Route::get('product/{slug}','Api\ProductController@detail');

Route::get('category','Api\CategoryController@index');
Route::post('category/store','Api\CategoryController@store');
Route::get('category/edit/{slug}','Api\CategoryController@edit');
Route::get('category/{slug}','Api\CategoryController@detail');

Route::get('banner','Api\BannerController@index');
Route::post('banner/store','Api\BannerController@store');
Route::get('banner/edit/{slug}','Api\BannerController@edit');
Route::get('banner/{slug}','Api\BannerController@detail');
