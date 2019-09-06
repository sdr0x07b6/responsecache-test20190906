<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/users', function () {
    return ['User1', 'User2', 'User3'];
})->middleware('cacheResponse:users');

Route::get('/products', function () {
    return ['Product1', 'Product2', 'Product3'];
})->middleware('cacheResponse:products');
