<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Rutas de los cursos
 */
//Route::middleware('auth:api')->get('/cursos', 'CourseController@all');
Route::middleware('auth:api')->post('/cursos', 'CourseController@store');
Route::middleware('auth:api')->post('/cursos/{id}', 'CourseController@update');

/**
 * Rutas de los tutores
 */

Route::middleware('auth:api')->post('/tutores', 'TutorController@store');
Route::middleware('auth:api')->post('/tutores/{id}', 'TutorController@update');
 /**
  * Rutas de los statuses
  */
Route::middleware('auth:api')->post('/estados', 'StatusController@store');
Route::middleware('auth:api')->post('/estados/{id}', 'StatusController@update');

/**
 * Rutas de los tipos
 */
Route::middleware('auth:api')->post('/tipos', 'TypeController@store');
Route::middleware('auth:api')->post('/tipos/{id}', 'TypeController@update');

/**
 * Rutas de los usuarios
 */
Route::middleware('auth:api')->post('/usuarios', 'UserController@save');
Route::middleware('auth:api')->post('/usuarios/{id}', 'UserController@update');
Route::middleware('auth:api')->post('/usuarios/{id}/account', 'UserController@password');

/**
 * Rutas de los roles
 */
Route::middleware('auth:api')->post('/roles', 'RoleController@store');
Route::middleware('auth:api')->post('/roles/{id}', 'RoleController@update');

/**
 * Rutas de los permisos
 */
Route::middleware('auth:api')->post('/permisos', 'PermissionController@store');
Route::middleware('auth:api')->post('/permisos/{id}', 'PermissionController@update');