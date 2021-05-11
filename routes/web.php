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

Route::get('/registro', 'RegisterController@registro');

Route::post('/user', 'UserController@store');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'LoginController@login')->name('login');

Route::post('/registrar', 'RegisterController@crear')->name('registrar');

Route::get('/vista/correo', 'HomeController@correo');

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => 'hasRole:admin,coordinator'], function () {
        Route::resource('/tutores', 'TutorController');

        Route::resource('/cursos', 'CourseController', ['only' => [
            'index', 'create', 'store', 'edit', 'update'
        ]]);

        Route::resource('/estados', 'StatusController');

        Route::resource('/tipos', 'TypeController');
    });

    Route::group(['middleware' => 'hasRole:admin'], function() {
        Route::resource('/usuarios', 'UserController', ['only' => [
            'index', 'create'
        ]]);

        Route::resource('/roles', 'RoleController');

        Route::resource('/permisos', 'PermissionController');
    });

    Route::group(['middleware' => 'hasRole:coordinator,admin,student'], function () {
        Route::resource('/usuarios', 'UserController', ['only' => [
            'show', 'edit', 'update', 'account', 'password'
        ]]);

        Route::get('/cursos/ver', 'CourseController@all');

        Route::resource('/cursos', 'CourseController', ['only' => [
            'show'
        ]]);

        Route::get('/usuarios/cursos/{id}', 'UserController@courses');

        Route::get('/usuarios/inscribir/{id}', 'UserController@subscribe');

        Route::get('usuarios/{id}/account', 'UserController@account');
    });
});