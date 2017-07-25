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
use App\Notificacion;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//this routes is for control of users
Route::get('users', 'UsersController@index')->middleware('auth');
Route::get('users/{id}/edit', 'UsersController@edit')->middleware('auth');
Route::match(['put', 'patch'], 'users/{id}', 'UsersController@update')->middleware('auth');
Route::delete('users/{id}', 'UsersController@destroy')->middleware('auth');
//****************************************************************************************

// this is to go to the main page
Route::get('/home', 'HomeController@index')->middleware('auth');;

//****************************************************************************************

// this route shows all providers in json format
Route::get('Providers', 'ProviderController@index')->middleware('auth');

// this route is to show the page to create providers
Route::post('/create/{nombre?}','ProviderController@create')->middleware('auth');

Route::get('Providers/create', 'ProviderController@create')->middleware('auth');
Route::get('Providers/{id}/show', 'ProviderController@show')->middleware('auth');
Route::get('Providers/{id}/edit', 'ProviderController@edit')->middleware('auth');

//"Providers" for "post" to store a new record
Route::post('Providers', 'ProviderController@store')->middleware('auth');

//"Providers/id" for "put" to update the registry by "id"
Route::match(['put', 'patch'], 'Providers/{id}', 'ProviderController@update')->middleware('auth');

//"providers/id" for "delete" to delete the registry by "id"
Route::delete('Providers/{id}', 'ProviderController@destroy')->middleware('auth');

//****************************************************************************************

Route::resource('quotes', 'QuotesController', ['only' => ['index', 'store', 'update', 'destroy']]);

//****************************************************************************************

// this route shows all customers in json format
Route::get('customers', 'CustomersController@index')->middleware('auth');

Route::get('customers/create', 'CustomersController@create')->middleware('auth');
Route::get('customers/{id}/show', 'CustomersController@show')->middleware('auth');
Route::get('customers/{id}/edit', 'CustomersController@edit')->middleware('auth');

//"customers" for "post" to store a new record
Route::post('customers', 'CustomersController@store')->middleware('auth');

//"customers/id" for "put" to update the registry by "id"
Route::match(['put', 'patch'], 'customers/{id}', 'CustomersController@update')->middleware('auth');

//"customers/id" for "delete" to delete the registry by "id"
Route::delete('customers/{id}', 'CustomersController@destroy')->middleware('auth');

//****************************************************************************************

// this route shows all articles in json format
Route::get('articles', 'ArticlesController@index')->middleware('auth');

Route::get('articles/create', 'ArticlesController@create')->middleware('auth');
Route::get('articles/{id}/show', 'ArticlesController@show')->middleware('auth');
Route::get('articles/{id}/edit', 'ArticlesController@edit')->middleware('auth');

//"articles" for "post" to store a new record
Route::post('articles', 'ArticlesController@store')->middleware('auth');

//"articles/id" for "put" to update the registry by "id"
Route::match(['put', 'patch'], 'articles/{id}', 'ArticlesController@update')->middleware('auth');

//"articles/id" for "delete" to delete the registry by "id"
Route::delete('articles/{id}', 'ArticlesController@destroy')->middleware('auth');

//****************************************************************************************

// this route shows all vehicles in json format
Route::get('vehicles', 'VehiclesController@index')->middleware('auth');

Route::get('vehicles/create', 'VehiclesController@create')->middleware('auth');
Route::get('vehicles/{id}/show', 'VehiclesController@show')->middleware('auth');
Route::get('vehicles/{id}/edit', 'VehiclesController@edit')->middleware('auth');

//"vehicles" for "post" to store a new record
Route::post('vehicles', 'VehiclesController@store')->middleware('auth');

//"vehicles/id" for "put" to update the registry by "id"
Route::match(['put', 'patch'], 'vehicles/{id}', 'VehiclesController@update')->middleware('auth');

//"vehicles/id" for "delete" to delete the registry by "id"
Route::delete('vehicles/{id}', 'VehiclesController@destroy')->middleware('auth');

//***************************************************************************************

// this route shows all invoices in json format
Route::get('invoices', 'InvoiceReportController@index')->middleware('auth');

Route::get('invoices/create', 'InvoiceReportController@create')->middleware('auth');

Route::get('invoices/{id}/show', 'InvoiceReportController@show')->middleware('auth');

Route::get('invoices/{id}/annular', 'InvoiceReportController@annular')->middleware('auth');

Route::get('invoices/{id}/download', 'InvoiceReportController@download')->middleware('auth');

//"invoices" for "post" to store a new record
Route::post('invoices', 'InvoiceReportController@store')->middleware('auth');

Route::get('invoices/createReportPurchase', 'InvoiceReportController@createReportPurchase')->middleware('auth');

Route::post('invoicesReportPurchase', 'InvoiceReportController@storeReportPurchase')->middleware('auth');

Route::get('invoices/{id}/showReportPurchase', 'InvoiceReportController@showReportPurchase')->middleware('auth');

Route::get('invoices/{id}/annularReportPurchase', 'InvoiceReportController@annularReportPurchase')->middleware('auth');

Route::get('invoices/{id}/downloadReportPurchase', 'InvoiceReportController@downloadReportPurchase')->middleware('auth');
//***************************************************************************************


// this route shows all providers in json format
Route::get('inventory', 'InventoriesController@index')->middleware('auth');
Route::get('inventory/{id}/show', 'InventoriesController@show')->middleware('auth');


//***************************************************************************************

// this route shows all providers in json format
Route::get('smallbox', 'SmallboxesController@index')->middleware('auth');
Route::get('smallbox/{id}/show', 'SmallboxesController@show')->middleware('auth');


//***************************************************************************************

// this route shows all message in json format
Route::get('message', 'MessageController@index')->middleware('auth');

Route::get('message/create', 'MessageController@create')->middleware('auth');
Route::get('message/{id}/edit', 'MessageController@edit')->middleware('auth');

//"message" for "post" to store a new record
Route::post('message', 'MessageController@store')->middleware('auth');

//"message/id" for "put" to update the registry by "id"
Route::match(['put', 'patch'], 'message/{id}', 'MessageController@update')->middleware('auth');

//"message/id" for "delete" to delete the registry by "id"
Route::delete('message/{id}', 'MessageController@destroy')->middleware('auth');

//***************************************************************************************
//this route is for send message to users when finish the decoration
Route::get('send', 'Sms@index')->middleware('auth');
Route::post('send/create', 'Sms@send')->middleware('auth');

//****************************************************************************************

//
Route::get('reports', 'ReportsController@index')->middleware('auth');
Route::post('reports', 'ReportsController@create')->middleware('auth');

//****************************************************************************************
//this route is for when any route not exist return home 
Route::get('/{nombre?}', function ($nombre = null) {
	if (is_null($nombre)) {
		return Redirect::to('/home');
	}
    return Redirect::to('/home');
});



