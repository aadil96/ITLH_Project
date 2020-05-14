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
//

// Create with factory

Route::get('create/client', function () {
	$client = factory(\App\Client::class)->create();
	return redirect()->route('client.login');
});


Route::get('create/{client}/assignment', function ($id) {
	$assignment = factory(\App\Assignment::class)->create();
	return redirect()->route('client.home');
});

Route::get('create/user', function () {
	$assignment = factory(\App\Batch::class)->make();
	dd($assignment);
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('home', 'HomeController@show')->name('freelancer.home');

Route::get('profile/{user}', 'HomeController@profile')->name('freelancer.profile')->middleware('auth:web,client');
Route::get('/logout', 'HomeController@logout');

Route::prefix('client')->group(function () {
	Route::get('register', 'Auth\RegisterController@showClientRegistrationForm')->name('client.register');
	Route::post('register', 'Auth\RegisterController@addClient');
	Route::get('login', 'ClientsLoginController@showLoginForm')->name('client.login');
	Route::post('login', 'ClientsLoginController@clientLogin');
	Route::get('home', 'ClientController@index')->name('client.home');
	Route::get('logout', 'ClientController@logout')->name('client.logout');
});

Route::prefix('client/{client}')->group(function () {
	Route::get('profile', 'ClientController@profile')->name('client.profile');
	Route::get('profile/edit', 'ClientController@editProfilePage')->name('client.edit');
	Route::post('profile/edit', 'ClientController@edit');
});

Route::prefix('assignment')->group(function () {
	Route::get('post', 'AssignmentsController@showPostAssignmentPage')->name('assignment.post');
	Route::post('post/{client}', 'AssignmentsController@addAssignment');
	Route::get('{id}', 'AssignmentsController@show')->name('assignment')/*->middleware('auth:web,client')*/;
});

Route::prefix('assignment/{assignment}/proposal')->group(function () {
	Route::get('post', 'ProposalsController@showPostProposalPage')->name('proposal.post');
	Route::post('post', 'ProposalsController@create');
	Route::post('{proposal}/approve', 'ProposalsController@approve')->middleware('auth:client');
	Route::post('{proposal}/reject', 'ProposalsController@reject')->middleware('auth:client');
});

Route::get('user/{user}/proposal/{proposal}', 'ProposalsController@showSelectedProposal')->middleware('auth:client')->name('proposal');
