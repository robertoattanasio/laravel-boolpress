<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', 'HomeController@index')->name('guest.homepage');

// localhost:8888/posts
Route::prefix('posts')
      ->group(function() {
            Route::get('/', 'PostController@index')->name('guest.posts.index');
            Route::get('/{slug}', 'PostController@show')->name('guests.posts.show');
      });

Route::prefix('categories')
      ->group(function() {
            Route::get('/', 'CategoryController@index')->name('guest.categories.index');
            Route::get('/{slug}', 'CategoryController@show')->name('guest.categories.show');
      });

Auth::routes();

// localhost:8888/admin
Route::prefix('admin')
      ->namespace('Admin')
      ->middleware('auth')
      ->group(function () {
           Route::get('/', 'MainController@index');
           Route::resource('/posts', PostController::class)->names([
                 'index' => 'admin.posts.index',
                 'create' => 'admin.posts.create',
                 'destroy' => 'admin.posts.destroy',
                 'update' => 'admin.posts.update',
                 'show' => 'admin.posts.show',
                 'edit' => 'admin.posts.edit',
                 'create' => 'admin.posts.create',
           ]);
      });