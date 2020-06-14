<?php

/* Admin Routes */

Route::prefix('admin')->group(function () {
    Route::get('register', 'Admin\AdminRegisterController@show')->name(
        'admin.register'
    );
    Route::post('register', 'Admin\AdminRegisterController@create');
    Route::get('login', 'Admin\AdminLoginController@show')->name('admin.login');
    Route::post('login', 'Admin\AdminLoginController@login');
    Route::get('logout', 'Admin\AdminController@logout')->name('admin.logout');
    Route::get('home', 'Admin\AdminController@show')->name('admin.home');
    Route::post('addBatch', 'Admin\AdminController@addbatch');
    Route::get('{assignment}/delete', 'Admin\AdminController@destroyAsssignment')->name('delete.assignment');
    Route::get('user/{user}/delete', 'Admin\AdminController@destroyUser')->name('delete.user');
    Route::get('client/{client}/delete', 'Admin\AdminController@destroyClient')->name('delete.client');
});

/* End */

Route::get('create/user', function () {
    $assignment = factory(\App\Batch::class)->make();
    dd($assignment);
});

Auth::routes();

/* Freelancer Routes */

Route::prefix('/')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@show')->name('freelancer.home');
    Route::get('profile/{user}', 'HomeController@profile')
        ->name('freelancer.profile')
        ->middleware('auth:web,client,admin');
    Route::get('profile/{user}/edit', 'HomeController@showEditPage')->name('freelancer.edit');
    Route::post('profile/{user}/edit', 'HomeController@update')->name('freelancer.edit');
    Route::get('/logout', 'HomeController@logout');
});

/* End */

/* Client Routes */

Route::prefix('client')->group(function () {
    Route::get(
        'register',
        'Auth\RegisterController@showClientRegistrationForm'
    )->name('client.register');
    Route::post('register', 'Auth\RegisterController@addClient');
    Route::get('login', 'Client\ClientsLoginController@showLoginForm')->name(
        'client.login'
    );
    Route::post('login', 'Client\ClientsLoginController@clientLogin');
    Route::get('home', 'Client\ClientController@index')->name('client.home');
    Route::get('logout', 'Client\ClientController@logout')->name('client.logout');
});

Route::prefix('client/{client}')->group(function () {
    Route::get('profile', 'Client\ClientController@profile')->name('client.profile');
    Route::get('profile/edit', 'Client\ClientController@editProfilePage')->name(
        'client.edit'
    );
    Route::post('profile/edit', 'Client\ClientController@edit');
});

/* End */

/* Assignment Routes */

Route::prefix('assignment')->group(function () {
    Route::get('post', 'AssignmentsController@showPostAssignmentPage')->name(
        'assignment.post'
    );
    Route::post('post/{client}', 'AssignmentsController@addAssignment');
    Route::get('{id}', 'AssignmentsController@show')->name(
        'assignment');
});

Route::prefix('assignment/{assignment}/proposal')->group(function () {
    Route::get('post', 'ProposalsController@showPostProposalPage')->name(
        'proposal.post'
    );
    Route::post('post', 'ProposalsController@create');
    Route::post(
        '{proposal}/approve',
        'ProposalsController@approve'
    )->middleware('auth:client');
    Route::post('{proposal}/reject', 'ProposalsController@reject')->middleware(
        'auth:client'
    );
});

/* End */

Route::get(
    'user/{user}/proposal/{proposal}',
    'ProposalsController@showSelectedProposal'
)
    ->middleware('auth:client')
    ->name('proposal');

/* Factory Routes */

Route::get('create/client', function () {
    $client = factory(\App\Client::class)->create();
    return redirect()->route('client.login');
});

Route::get('create/{client}/assignment', function ($id) {
    $assignment = factory(\App\Assignment::class)->create();
    return redirect()->route('client.home');
});

/* End */
