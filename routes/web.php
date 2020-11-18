<?php

Auth::routes(['verify' => true]);

Route::name('home')->get('/', 'HomeController@index');

Route::middleware('admin')->group(function () {

    Route::resource('matiere', 'MatiereController', [
        'except' => 'show'
    ]);

    Route::resource('user', 'UserController', [
        'only' => ['index', 'edit', 'update', 'destroy']
    ]);

    Route::name('orphans.')->prefix('orphans')->group(function () {
        Route::name('index')->get('/', 'AdminController@orphans');
        Route::name('destroy')->delete('/', 'AdminController@destroy');
    });

    Route::name('maintenance.')->prefix('maintenance')->group(function () {
        Route::name('index')->get('/', 'AdminController@edit');
        Route::name('update')->put('/', 'AdminController@update');
    });
});

Route::middleware('auth', 'verified')->group(function () {

    Route::resource('lecon', 'LeconController', [
        'only' => ['create', 'store', 'destroy', 'update']
    ]);

    Route::resource('profile', 'ProfileController', [
        'only' => ['edit', 'update', 'destroy', 'show'],
        'parameters' => ['profile' => 'user']
    ]);

    Route::resource('professeur', 'ProfesseurController', [
        'except' => 'show'
    ]);

    Route::name('lecon.')->middleware('ajax')->group(function () {
        Route::prefix('lecon')->group(function () {
            Route::name('professeurs.update')->put('{lecon}/professeurs', 'LeconController@professeursUpdate');
            Route::name('description')->put('{lecon}/description', 'LeconController@descriptionUpdate');
            Route::name('professeurs')->get('{lecon}/professeurs', 'LeconController@professeurs');
        });
        Route::name('rating')->put('rating/{lecon}', 'LeconController@rate');
    });

    Route::name('notification.')->prefix('notification')->group(function () {
        Route::name('index')->get('/', 'NotificationController@index');
        Route::name('update')->patch('{notification}', 'NotificationController@update');
    });
});

Route::name('professeur')->get('professeur/{slug}', 'LeconController@professeur');
Route::name('matiere')->get('matiere/{slug}', 'LeconController@matiere');
Route::name('user')->get('user/{user}', 'LeconController@user');
Route::name('language')->get('language/{lang}', 'HomeController@language');
Route::middleware('ajax')->name('lecon.click')->patch('lecon/{lecon}/click', 'LeconController@click');
