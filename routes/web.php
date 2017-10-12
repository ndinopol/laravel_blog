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


/*Route::get('/', function () {
    return view('index');

});*/

Route::get('/',array('as' => 'index', 'uses' => 'UserController@index'));
Route::get('/signin',array('as'=>'glogin','uses'=>'UserController@googleLogin'));
Route::get('/dashboard',array('as'=>'user.posts','uses'=>'PostsController@show'));
Route::get('/dashboard/post',array('as'=>'user.addposts','uses'=>'PostsController@create'));
Route::post('/dashboard/post',array('as'=>'user.submitposts','uses'=>'PostsController@store'));
Route::get('/edit/{post}',array('as'=>'user.editposts','uses'=>'PostsController@edit'));
Route::post('/edit/{post}',array('as'=>'user.editposts','uses'=>'PostsController@update'));
Route::get('/delete/{post}',array('as'=>'user.deleteposts','uses'=>'PostsController@destroy'));
Route::get('/logout',array('as'=>'user.logout','uses'=>'UserController@logout'));
Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
