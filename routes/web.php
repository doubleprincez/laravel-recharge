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

Route::get('/', 'GuestsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// User RouteServiceProvider
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', ["uses" => "ProfileController@profile", "as" => "profile.edit"]);
Route::get('/downlines', 'DownlinesController@index')->name('user.downlines');
Route::get('/transactions', 'TransactionController@index')->name('user.transactions');
Route::get('/activate', 'ActivateController@index')->name('user.activate');
Route::get('/confirmation', 'ActivateController@confirm');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/cashout', 'TransactionController@cashout_show')->name('cashout.show');


Route::post('/recharge', 'RechargeController@index')->name('recharge');
Route::post('/data', 'DataController@index')->name('data');
Route::post('/cable', 'CablesController@index')->name('cable');
Route::post('/electricity', 'ElectricitiesController@index')->name('electricity');
Route::post('/wallet', 'WalletController@index')->name('wallet');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::post('pin', 'PinController@index')->name('pin');
Route::post('/activation', 'PaymentController@activationGateway')->name('activate');
Route::post('/fetchWalletAccount', 'HomeController@getAccountDetails');
Route::post('/submitPayForOthers', 'PaymentController@payForOthers');
Route::put('profile', 'ProfileController@update')->name('profile.update');
Route::post('cashout', 'TransactionController@cashout_create')->name('cashout.create');
//
/// Admin Dashboard
//
// admin routes grouped
route::group(array('prefix' => 'cpanel'), function () {
    Route::get('/login', 'AdminDashboardController@index')->name('admin.login');
    Route::get('admin-page', 'AdminDashboardController@index')->name('admin.index');
    Route::get('admin-add', 'AdminDashboardController@add')->name('admin.add');
    Route::get('admins', 'AdminDashboardController@admins')->name('admins');
    Route::get('admin-webset', 'AdminDashboardController@webSettings')->name('admin.webset');
    Route::get('admin-usbonus', 'AdminDashboardController@usBonus')->name('admin.usbonus');
    Route::get('admin-spcbonus', 'AdminDashboardController@spcBonus')->name('admin.spcbonus');
    Route::get('admin-airtime', 'AdminDashboardController@airtime')->name('admin.airtime');
    Route::get('admin-cabletv', 'AdminDashboardController@cable')->name('admin.cabletv');
    Route::get('admin-datapurchase', 'AdminDashboardController@dataPurchase')->name('admin.datapurchase');
    Route::get('admin.pin', 'AdminDashboardController@pin')->name('admin.pin');
    Route::get('admin-electric', 'AdminDashboardController@electric')->name('admin.electric');
    Route::get("/user/special/{id}", ["uses" => "AdminDashboardController@special", "as" => "user.special"]);
    Route::get("/user/special/unset/{id}", ["uses" => "AdminDashboardController@specialunset", "as" => "user.specialunset"]);
    Route::get("/admin/servies/", ["uses" => "AdminDashboardController@serve", "as" => "admin.services"]);
    Route::get("/user/destroyer/{id}", ["uses" => "AdminDashboardController@userdestroy", "as" => "user.delete"]);
    Route::get("/user/update/{id}", ["uses" => "AdminDashboardController@userupdate", "as" => "user.update"]);
    Route::get("/bonus/card/{id}", ["uses" => "AdminDashboardController@resetcard", "as" => "card.reset"]);
    Route::get("/bonus/card/update/{id}", ["uses" => "AdminDashboardController@updatecard", "as" => "card.update"]);
    Route::get("/bonus/monthly/{id}", ["uses" => "AdminDashboardController@resetmonthly", "as" => "monthly.reset"]);
    Route::get("/bonus/monthly/update/{id}", ["uses" => "AdminDashboardController@updatemonthly", "as" => "monthly.update"]);
    Route::get("/bonus/travelling/{id}", ["uses" => "AdminDashboardController@resettravelling", "as" => "travel.reset"]);
    Route::get("/bonus/travelling/update/{id}", ["uses" => "AdminDashboardController@updatetravelling", "as" => "travel.update"]);
    Route::get("/bonus/festival/{id}", ["uses" => "AdminDashboardController@resetfestival", "as" => "festival.reset"]);
    Route::get("/bonus/festival/update/{id}", ["uses" => "AdminDashboardController@updatefestival", "as" => "festival.update"]);
    Route::get("/bonus/specialbonus/update/{id}", ["uses" => "AdminDashboardController@updatespecialbonus", "as" => "specialbonus.update"]);
    Route::get("/admin/update/{id}", ["uses" => "AdminLoginController@updateadmin", "as" => "admin.detail"]);
    Route::post("/Administrators/password/{id}", ["uses" => "AdminDashboardController@adminpassword", "as" => "admin.password"]);
    Route::post("/administrators/include", ["uses" => "AdminDashboardController@save", "as" => "admin.include"]);
    Route::put("/users/bonus/update/{id}", ["uses" => "AdminDashboardController@updatebonus", "as" => "userbonus.put"]);
 Route::get('/admin/routes', 'HomeController@admin')->middleware('admin')->name('admin.in');
});
