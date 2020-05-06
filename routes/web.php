<?php

use \App\Client;
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
//

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('profile/{id}', 'HomeController@profile')->name('profile');
Route::get('/logout', 'HomeController@logout');

Route::prefix('client')->group(function () {
	Route::get('register', 'Auth\RegisterController@showClientRegistrationForm')->name('client.register');
	Route::post('register', 'Auth\RegisterController@addClient');
	Route::get('login', 'ClientsLoginController@showLoginForm')->name('client.login');
	Route::post('login', 'ClientsLoginController@clientLogin');
	Route::get('home', 'ClientController@index')->name('client.home');
	Route::get('profile/{id}', 'ClientController@profile')->name('client.profile');
	Route::get('profile/{id}/edit', 'ClientController@editProfilePage');
	Route::post('profile/{id}/edit', 'ClientController@edit');
	Route::get('logout', 'ClientController@logout')->name('client.logout');
});

// Route::get('client/assignment/post/{client}', 'AssignmentsController@showPostAssignmentPage')->name('assignment.post');
// Route::post('client/assignment/post/{client}', 'AssignmentsController@addAssignment');

Route::prefix('assignment')->group(function ()
{
	Route::get('post/{client}', 'AssignmentsController@showPostAssignmentPage')->name('assignment.post');
	Route::post('post/{client}', 'AssignmentsController@addAssignment');
	Route::get('{id}', 'AssignmentsController@show')->name('assignment')/*->middleware('auth:web,client')*/;
});

Route::prefix('assignment/{assignmentId}/proposal')->group(function(){
	Route::get('post', 'ProposalsController@showPostProposalPage')->name('proposal.post');
	Route::post('post', 'ProposalsController@create');
	Route::post('{proposalId}/approve', 'ProposalsController@approve')->middleware('auth:client');
	Route::post('{proposalId}/reject', 'ProposalsController@reject')->middleware('auth:client');
});

Route::get('/proposal/{proposalId}', 'ProposalsController@showSelectedProposal')->middleware('auth:client')->name('proposal');
