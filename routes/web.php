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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });

    Route::resource('accounts', 'AccountsController');
    Route::resource('transactions', 'TransactionsController');
    Route::resource('funds_transfer', 'FundsTransferController');
});
