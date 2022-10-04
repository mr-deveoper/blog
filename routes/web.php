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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes([
  'confirm' => false, // Routes of Registration
  'reset' => false,    // Routes of Password Reset
  'verify' => false,   // Routes of Email Verification
]);
Route::resource('posts', 'PostController');
