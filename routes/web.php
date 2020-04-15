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

Route::prefix('client')->group(function () {
	Route::get('register', 'Auth\RegisterController@showClientRegistrationForm')->name('client.register');
	Route::post('register', 'Auth\RegisterController@addClient');
	Route::get('login', 'ClientsLoginController@showClientLoginForm')->name('client.login');
	Route::post('login', 'ClientsLoginController@clientLogin');
	Route::get('home', 'ClientController@index')->name('client.home');
	Route::get('logout', 'ClientController@logout');
});

Route::prefix('assignment')->group(function ()
{
	Route::get('post', 'AssignmentsController@showPostAssignmentPage')->name('assignment.post');
	Route::post('post', 'AssignmentsController@addAssignment');
	Route::get('{id}', 'AssignmentsController@show')->name('assignment')->middleware('auth:web,client');
});

Route::prefix('assignment/{assignmentId}/proposal')->group(function(){
	Route::get('post', 'ProposalsController@showPostProposalPage')->name('proposal.post');
	Route::post('post', 'ProposalsController@create');
	Route::post('{proposalId}/approve', 'ProposalsController@approve')->middleware('auth:client');
	Route::post('{proposalId}/reject', 'ProposalsController@reject')->middleware('auth:client');
});







// Route::get('/search', 'ClientController@index');

Route::get('/proposal/{proposalId}', 'ProposalsController@showSelectedProposal')->middleware('auth:client')->name('proposal');

// Route::group(['middleware' => ['auth', 'auth:client']],function () {



	 // Route::get('/home', 'HomeController@index')->name('home');
	 // Route::get('/client/home', 'ClientController@index')->name('client.home');

// });
