<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 
Route::post('/store','StoreAppAPIController@index'); 
Route::post('/store/get-qrcode-timer','StoreAppAPIController@getQRCodeTimer'); 
Route::post('/store/get-employee-list','StoreAppAPIController@getEmployeeList');
Route::post('/store/generate-qrcode','StoreAppAPIController@insertLocSessionDet');
Route::post('/store/get-registered-fr','StoreAppAPIController@getEmpFR');
Route::post('/store/insert-fr','StoreAppAPIController@insertEmpFR');
Route::post('/store/insert-update-emp-visit','StoreAppAPIController@insertUpdateEmpVisit');
Route::post('/store/login','StoreAppAPIController@login');
Route::post('/store/upload-image','StoreAppAPIController@uploadImage');
Route::post('/store/registration-upload-image','StoreAppAPIController@registrationUploadImage');
Route::get('/store/ping','StoreAppAPIController@ping');

Route::post('/employee','EmployeeAppAPIController@index'); 
Route::post('/employee/insert-update-emp-visit','EmployeeAppAPIController@insertUpdateEmpVisit');