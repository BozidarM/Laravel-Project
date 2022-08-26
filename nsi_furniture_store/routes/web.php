<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('welcome');
});

/*Using resource() in the route is going to automatically map the following methods in the Controller.

GET /users, mapped to the method named index().
GET /users/create, mapped to create().
GET /users/{user}, mapped to show().
GET /users/{user}/edit, mapped to edit().
POST /users, mapped to store().
PUT /users/{user}, mapped to update().
DELETE /users/{user}, mapped to destroy().
*/
Route::resource('users', UserController::class);
Route::resource('furniture', FurnitureController::class);
Route::resource('orders', OrderController::class);
Route::resource('categories', CategoryController::class);

// Route::get('/furniture', [FurnitureController::class, 'index']);
// Route::get('/orders', [OrderController::class, 'index']);
// Route::get('/categories', [CategoryController::class, 'index']);
