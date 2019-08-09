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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/','GuestsController@index');

Auth::routes();

Route::get('/home',  'HomeController@index' )->name('home');
// User RouteServiceProvider
Route::get('/profile','ProfileController@index')->name('profile');
Route::get('/profile/edit', ["uses"=>"ProfileController@profile", "as" => "profile.edit"]);
Route::get('/downlines', 'DownlinesController@index' )->name('user.downlines');
Route::get('/transactions','TransactionController@index')->name('user.transactions');
Route::get('/activate','ActivateController@index')->name('user.activate');
Route::get('/confirmation','ActivateController@confirm');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/cashout','TransactionController@cashout_show')->name('cashout.show');



Route::post('/recharge','RechargeController@index')->name('recharge');
Route::post('/data', 'DataController@index')->name('data');
Route::post('/cable','CablesController@index')->name('cable');
Route::post('/electricity','ElectricitiesController@index')->name('electricity');
Route::post('/wallet','WalletController@index')->name('wallet');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::post('pin','PinController@index')->name('pin');
Route::post('/activation','PaymentController@activationGateway')->name('activate');
Route::post('/fetchWalletAccount','HomeController@getAccountDetails');
Route::post('/submitPayForOthers','PaymentController@payForOthers');
Route::put('profile','ProfileController@update')->name('profile.update');
Route::post('cashout','TransactionController@cashout_create')->name('cashout.create');
