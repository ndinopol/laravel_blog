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
Route::get('/signin',array('as'=>'glogin','uses'=>'UserController@googleLogin')) ;
Route::get('/dashboard',array('as'=>'user.posts','uses'=>'PostsController@show')) ;
Route::get('/dashboard/post',array('as'=>'user.addposts','uses'=>'PostsController@create')) ;
Route::get('/logout',array('as'=>'user.logout','uses'=>'UserController@logout')) ;
Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
