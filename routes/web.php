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
    return view('welcome');
});

Auth::routes();
// RUTA GENERAL
Route::get('/', 'HomeController@index')->name('home');

// USUARIOS
Route::get('/settings', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/update-password', 'UserController@changePassword')->name('user.update-password');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

// IMAGEN
Route::get('/upload-photo', 'ImageController@create')->name('image.create');
Route::post('/photo/save', 'ImageController@save')->name('image.save');
Route::get('/photo/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/photo/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/photo/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/photo/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/photo/update', 'ImageController@update')->name('image.update');

// COMENTARIO
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

// LIKE
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('likes');

