<?php
Route::get('/', function () {return view('index');})->name('home');
// Route::get('dashboard',['as'=>'home', function () {return view('layouts/layout');}]);
// Route::post('dashboard',function (){});
Route::resource('dashboard','DashboardController');
// Route::get('users',['as'=>'users', function () {return view('users/create');}]);
Route::resource('users', 'UsersController');
Route::get('userspdf', 'UsersController@generatePDF')->name('users.pdf');
Route::resource('user_types','UserTypesController');
Route::resource('sewers','SewersController');
Route::resource('complaints','ComplaintsController');
Route::post('status', 'ComplaintsController@status')->name('complaints.status');
Route::post('fixing', 'ComplaintsController@fixing')->name('complaints.fixing');
Route::get('compalintspdf', 'ComplaintsController@generatePDF')->name('complaints.pdf');
Route::get('compalintspdffixing', 'ComplaintsController@generatePDFfixing')->name('pdf.fixing');
Route::get('compalintspdfsolved', 'ComplaintsController@generatePDFsolved')->name('pdf.solved');
Route::resource('charts','ChartsController');
Route::resource('alerts','AlertsController');
Route::post('alertsstatus', 'AlertsController@status')->name('alerts.status');
Route::post('alertsfixing', 'AlertsController@fixing')->name('alerts.fixing');
Route::post('complaints/confirmation','ComplaintsController@sendsms')->name('auth.sms');
// Route::resource('complaints/sendsms','');





//FORMULARIO LOGIN
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//INICIO DE SESION
Route::post('login', 'Auth\LoginController@login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
