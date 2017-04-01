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


Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('verify', 'VerifyController');

Route::resource('loan', 'LoanController');
Route::get('p_customer','LoanController@potentialCustomer');

Route::get('/dun/operation/{method}/{id}','DunController@operation');
Route::resource('dun','DunController');

Route::group(['prefix'=>'manager', 'namespace'=>'manager', ],function(){
    Route::resource('customers','CustomersController');
    Route::resource('users','UsersController');
});

Route::any('data','Manager\StaticticsController@data');


Route::any('datatables', 'DatatablesController@getIndex');
Route::any('modal/{id}/{modal}','DatatablesController@modal');
Route::any('phone','TestController@phone');
Route::any('con','TestController@connecter');
Route::any('query','VerifyController@query');
