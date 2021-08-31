<?php

use App\Models\UserDetails;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/**
 * Authentication Controller
 */
Route::any('/','AuthController@index');
Route::get('/logout','AuthController@logout');
Route::post('/pin-check','AuthController@getUserPIN');


/**
 * Page Controller
 */
Route::get('/home','PageController@viewHome');
Route::get('/selfie','PageController@viewSelfie')->name('selfie');
Route::any('/logsheet','PageController@viewLogsheet')->name('logsheet');
Route::any('/approval','PageController@viewApproval')->name('approval');
// Route::any('/approval-redirect','PageController@viewApproval')->name('approval');

/*
*  Monitoring Controller
*/
Route::post('/monitoring','MonitoringController@getCheckInOut');



/*
*  Selfie Controller
*/

Route::post('/selfie-save','SelfieController@SaveSelfie');
Route::post('/selfie-get','SelfieController@GetImage');

/*
*  Logsheet Controller
*/

Route::post('/logsheet-save','LogsheetController@saveLogsheet');
Route::post('/logsheet-get','LogsheetController@getLogsheet');
Route::post('/logsheet-update','LogsheetController@updateLogsheet');

/*
*   Approver Controller
*/
Route::post('/approval-get','ApprovalController@getApproval');
Route::post('/approve','ApprovalController@approve');


/*
*  Options Controller
*/

Route::get('/dc-get','OptionsController@getDC');
Route::post('/stores-get','OptionsController@getStore');
Route::post('/emp-get','OptionsController@getEmployeeList');


/**
 * Email Controller
 */
Route::post('/selfie-email','MailController@selfieEmail');
Route::post('/logsheet-email','MailController@logsheetEmail');
Route::post('/approve-email','MailController@approvalEmail');


Route::get('/error/401', function () { return view('error.401');});
Route::get('/error/404', function () { return view('error.404');});

Route::get('/session', function(){
    $userEmpID = MyHelper::decryptMyHub($_COOKIE['Usr_ID']);
    $userDetails = UserDetails::getUserDetails($userEmpID);
    DUMP($userDetails);
    DUMP($userEmpID);
    DUMP(Myhelper::decrypt(Session::get('SuperiorEmail')));
    DUMP(Myhelper::decrypt(Session::get('Email')));

});
