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

Route::get('/', 'DashboardController@index');

// product
Route::get('/product', 'ProductController@index');
Route::get('/product/export', 'ProductController@exportProduct');
Route::post('/product/tambah', 'ProductController@addProduct')->name('add_product');
Route::get('/product/subcategory', 'ProductController@subCategory');
Route::delete('/product/delete/{id}', 'ProductController@deleteProduct');
Route::get('/product/{id}/detail', 'ProductController@detailProduct');

// kategori
Route::get('/kategori', 'CategoryController@index');
Route::post('/kategory/tambah', 'CategoryController@addCategory')->name('add_category');
Route::delete('/kategori/delete/{id}', 'CategoryController@deleteCategory');

// subcategory
Route::get('/subcategory', 'CategoryController@sub_category');
Route::post('/subcategory/tambah', 'CategoryController@addSubcategory')->name('add_subcategory');
Route::delete('/subcategory/delete/{id}', 'CategoryController@deleteSubcategory');