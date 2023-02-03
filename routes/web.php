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

Route::get('/sign-up', 'CustomerController@index')->name('sign-up');
Route::get('/sign-up/{ref_id}', 'CustomerController@index')->name('referral');
Route::get('/check_cust/{email}', 'CustomerController@checkCust')->name('check.customer');
Route::post('/sign-up', 'CustomerController@store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/referral_list', 'ReferralController@index')->name('referral');
Route::get('/reflist_export', 'ReferralController@exportRefList');
Route::get('/user_profile/{id}', 'ReferralController@userProfile');

Route::get('/search', 'SearchController@index')->name('search');
Route::get('/search/{val}', 'SearchController@search')->name('search-result');

Route::get('/registered_admin', 'AdminController@index')->name('admin');
Route::get('/delete_admin/{id}', 'AdminController@delete');

/* Test Route 
Route::get('/email', function()
{
    $valData = [
        'firstname'     => 'fname',
        'lastname'      => 'lname',
        'email'         => 'email',
        'gender'        => 'gender',
        'dob'           => 'dob',
        'phone'         => 'phone',
        'state'         => 'state',
        'country'       => 'country',
        'acct_name'     => 'acct_name',
        'bank_name'     => 'bank_name',
        'acct_num'      => 'acct_num',
    ];
    $ref_url = url('/');
    return view('emails.customerDetails', ['profile' => $valData, 'ref_url' => $ref_url]);
});
*/