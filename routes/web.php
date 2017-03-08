<?php

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();

Route::group(['middleware' =>['web', 'auth']], function() {
    Route::get('/', 'HomeController@index');

    Route::group(['middleware' =>['professor']], function() {
        Route::get('blocks', 'BlocksController@index');
        Route::get('blocks/create', 'BlocksController@create');
        Route::post('blocks', 'BlocksController@store');
        Route::get('blocks/{block}', 'BlocksController@show');
        Route::get('blocks/{block}/edit', 'BlocksController@edit');
        Route::put('blocks/{block}', 'BlocksController@update');
        Route::delete('blocks/{block}', 'BlocksController@delete');

        Route::get('courses', 'CoursesController@index');
        Route::get('courses/create', 'CoursesController@create');
        Route::post('courses', 'CoursesController@store');
        Route::get('courses/{course}', 'CoursesController@show');
        Route::get('courses/{course}/edit', 'CoursesController@edit');
        Route::put('courses/{course}', 'CoursesController@update');
        Route::delete('courses/{}');

        Route::get('departments', 'DepartmentController@index');
        Route::get('departments/create', 'DepartmentController@create');
        Route::post('departments', 'DepartmentController@store');
        Route::get('departments/{department}', 'DepartmentController@show');
        Route::get('departments/{department}/edit', 'DepartmentController@edit');
        Route::put('departments/{department}', 'DepartmentController@update');
        Route::delete('departments/{department}', 'DepartmentController@delete');

        Route::get('rooms', 'RoomsController@index');
        Route::get('rooms/create', 'RoomsController@create');
        Route::post('rooms', 'RoomsController@store');
        Route::get('rooms/{room}', 'RoomsController@show');
        Route::get('rooms/{room}/edit', 'RoomsController@edit');
        Route::put('rooms/{room}', 'RoomsController@update');
        Route::delete('rooms/{room}', 'RoomsController@delete');

        Route::get('users', 'UsersController@index');
        Route::get('users/create', 'UsersController@create');
        Route::post('users', 'UsersController@store');
        Route::get('users/{user}', 'UsersController@show');
        Route::get('users/{user}/edit', 'UsersController@edit');
        Route::put('users/{user}', 'UsersController@update');
        Route::delete('users/{user}', 'UsersController@delete');

        Route::get('subjects', 'SubjectsController@index');
        Route::get('subjects/create', 'SubjectsController@create');
        Route::post('subjects', 'SubjectsController@store');
        Route::get('subjects/{subject}', 'SubjectsController@show');
        Route::get('subjects/{subject}/edit', 'SubjectsController@edit');
        Route::put('subjects/{subject}', 'SubjectsController@update');
        Route::delete('subjects/{subject}', 'SubjectsController@delete');
    });
});

Route::get('schedule', 'SchedulesController@index');
Route::post('schedule', 'SchedulesController@store');
Route::get('schedule/{department}', 'SchedulesController@department');
Route::put('schedule/{schedule}', 'SchedulesController@update');
Route::delete('schedule/{schedule}', 'SchedulesController@delete');