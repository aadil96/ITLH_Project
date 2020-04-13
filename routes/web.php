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

Route::get('client/profile/{id}', function ($id){

	$client = \App\Client::where('id', $id)->first();
	$assignment = \App\Assignment::where('id', $id)->first();

	return view('client-profile', compact('client', 'assignment'));
});

Route::get('profile/{id}', function ($id){

	$user = \App\User::where('id', $id)->first();
	$assignment = \App\Assignment::where('id', $id)->first();

	return view('freelancer-profile', compact('user', 'assignment'));
});

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout');

Route::get('/client/register', 'Auth\RegisterController@showClientRegistrationForm');
Route::post('/client/register', 'Auth\RegisterController@addClient');


Route::get('/client/login', 'ClientsLoginController@showClientLoginForm')->name('client.login');
Route::post('/client/login', 'ClientsLoginController@clientLogin');


Route::get('/client/home', 'ClientController@index')->name('client.home');
Route::get('client/logout', 'ClientController@logout');
// Route::get('/search', 'ClientController@index');

Route::get('{assignmentId}/post/proposal', 'ProposalsController@showPostProposalPage');
Route::post('post/proposal', 'ProposalsController@create');
Route::get('/assignment/{assignmentId}/proposals', 'ProposalsController@ProposalsPage')->middleware('auth:client');
Route::get('/proposal/{proposalId}', 'ProposalsController@showSelectedProposal')->middleware('auth:client')->name('proposal');
Route::post('/assignment/{assignmentId}/proposal/{proposalId}/approve', 'ProposalsController@approve')->middleware('auth:client');
Route::post('/assignment/{assignmentId}/proposal/{proposalId}/reject', 'ProposalsController@reject')->middleware('auth:client');

// Route::group(['middleware' => ['auth', 'auth:client']],function () {

Route::get('/post/assignment', 'AssignmentsController@showPostAssignmentPage')->middleware('auth:client');
Route::post('/post/assignment', 'AssignmentsController@addAssignment')->middleware('auth:client');
Route::get('/assignment/{id}', 'AssignmentsController@show')->middleware('auth:web,client');

	 // Route::get('/home', 'HomeController@index')->name('home');
	 // Route::get('/client/home', 'ClientController@index')->name('client.home');

// });
