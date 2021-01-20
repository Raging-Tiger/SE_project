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
#Route::get('/home', [HomeController, 'index'])->name('home');

###ADMIN routes
/*User management routes*/
Route::get('/admin/users', 'UserController@adminUsersView');
Route::get('/admin/users/{id}/change_role', 'UserController@adminUsersRoleShow');
Route::post('/admin/users/{id}/change_role', 'UserController@setRole');
Route::get('/admin/users/set_inh', 'UserController@assignInh');
Route::post('/admin/users/set_inh', 'UserController@setUser');

/*Inhabitant management*/
Route::get('/admin/addinh', 'InhabitantController@addInhView');
Route::post('/admin/addinh', 'InhabitantController@addInh');
Route::get('/admin/inhabitants', 'InhabitantController@adminInhabitantView');
Route::get('/admin/inhabitants/{id}', 'InhabitantController@connectWithInh');
Route::post('/admin/inhabitants/{id}', 'InhabitantController@connectWithInh');
Route::delete('/admin/inhabitants/{id}', 'InhabitantController@destroyInhApp');
Route::match(['get', 'post'],'/admin/inhabitants/{id}/extra', 'InhabitantController@addInhApp');

/*Apartment management*/
Route::get('/admin/apartments', 'ApartmentController@adminApartmentView');
//Route::post('/admin/apartments', 'ApartmentController@adminApartmentView');
Route::post('/admin/apartments/{id}', 'ApartmentController@editApartmentView');
Route::get('/admin/apartments/{id}', 'ApartmentController@editApartmentView');

Route::match(['get', 'post'],'/admin/apartments/data/save', 'ApartmentController@saveApartmentView');

/*Fines - routes under admin middleware*/
Route::get('/admin/fines', 'FineController@finesView');
Route::get('/admin/fines/add', 'FineController@addFinesView');
Route::post('/admin/fines/add', 'FineController@postSearch');
Route::get('/admin/fines/add/{id}', 'FineController@fineShow');
Route::match(['get', 'post'],'/admin/fines/list', 'FineController@setFine');
Route::post('/admin/fines/edit/{id}', 'FineController@editFine');
Route::get('/admin/fines/edit/{id}', 'FineController@editFine');
Route::match(['get', 'post'],'/admin/fines/delete', 'FineController@deleteFine');
Route::match(['get', 'post'], '/admin/fines/edit', 'FineController@setFineEdit');

Route::post('/admin/fines/edit/status/{id}', 'FineController@editFineStatus');
Route::get('/admin/fines/edit/status/{id}', 'FineController@editFineStatus');
Route::match(['get', 'post'], '/admin/fines/status', 'FineController@setFineStatus');


/*Meters */
Route::get('/admin/meters', 'MeterController@adminMeterView');
Route::match(['get', 'post'],'/uploadfile','MeterController@uploadFile');

Route::post('/admin/meters/edit/{id}', 'MeterController@editMeter');
Route::get('/admin/meters/edit/{id}', 'MeterController@editMeter');
Route::match(['get', 'post'], '/admin/meters/edit', 'MeterController@setMeterEdit');

/*Notifications*/
Route::get('/notifications', 'NotificationController@see');
Route::match(['get', 'post'], '/notifications/delete', 'NotificationController@delete');
Route::post('/notifications/edit/{id}', 'NotificationController@edit');
Route::match(['get', 'post'], '/notifications/save', 'NotificationController@save');
Route::post('/notifications/add', 'NotificationController@addNewView');
Route::match(['get', 'post'],'/notifications/added', 'NotificationController@addNew');
Route::get('/notifications/add', 'NotificationController@addNewView');
Route::get('/notifications/edit/{id}', 'NotificationController@edit');

/*Bills*/
Route::match(['get', 'post'],'/admin/bills', 'BillController@listBills');
Route::match(['get', 'post'],'/admin/bill/add', 'BillController@makeBillView');
Route::match(['get', 'post'],'/admin/bills/set', 'BillController@setBills');
Route::match(['get', 'post'],'/admin/bills/edit/{id}', 'BillController@editBill');
Route::match(['get', 'post'],'/admin/bills/edit', 'BillController@setBillEdit');
Route::match(['get', 'post'],'/admin/bills/download', 'BillController@downloadBill');

###LOCALIZATION routes
/*Localization - according to NFR*/
Route::get('lang/{locale}', 'LanguageController');


/*General*/
Route::get('/', 'NotificationController@index');

/*Tenant*/
Route::get('/appartment', 'ApartmentController@index');
Route::match(['get', 'post'],'/appartment/email', 'ApartmentController@email');

Route::get('/fines', 'FineController@index');
Route::match(['get', 'post'],'/fines/pdf', 'FineController@download');

Route::get('/bills', 'BillController@index');
Route::match(['get', 'post'],'/uploadbill','BillController@showUploadFile');
Route::match(['get', 'post'],'/bills/pdf', 'BillController@download');
