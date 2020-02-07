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


   
	Route::get('/', function () {
	    return view('index');
	});

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
	// Route::get('/logout', 'HomeController@logout');


	Route::get('/client/register', 'Auth\RegisterController@showClientRegistrationForm');
	Route::post('/client/register', 'Auth\RegisterController@addClient');


	Route::get('/client/login', 'Auth\LoginController@showClientLoginForm')->name('client.login');
	Route::post('/client/login', 'Auth\LoginController@clientLogin');


	Route::get('/client/home', 'ClientController@index')->name('client.home');
	Route::get('client/logout', 'ClientController@logout');
	Route::get('/search', 'ClientController@index');

Route::middleware(['auth', 'auth:client'])->group(function () {

	Route::get('/post/assignment', 'AssignmentsController@showPostAssignmentPage');
	Route::post('/post/assignment', 'AssignmentsController@addAssignment');
	Route::get('/assignment/{id}', 'AssignmentsController@show');

	 


});