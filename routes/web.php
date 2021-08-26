<?php

use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('welcome');
});
Route::get('category-tree-view',['uses'=>'App\Http\Controllers\CategoryController@manageCategory']);
*/
Route::get('/',['uses'=>'App\Http\Controllers\CategoryController@manageCategory']);
Route::post('add-category',['as'=>'add.category','uses'=>'App\Http\Controllers\CategoryController@addCategory']);
Route::post('delete-category',['as'=>'delete.category','uses'=>'App\Http\Controllers\CategoryController@deleteCategory']);
Route::post('edit-category',['as'=>'edit.category','uses'=>'App\Http\Controllers\CategoryController@editCategory']);
