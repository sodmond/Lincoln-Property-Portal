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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sign-up', 'CustomerController@index')->name('sign-up');
Route::get('/sign-up/{ref_id}', 'CustomerController@index')->name('referral');
Route::get('/checkCust/{email}', 'CustomerController@checkCust');
Route::post('/sign-up', 'CustomerController@store');
