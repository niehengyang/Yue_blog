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

Route::get('/home', 'HomeController@index')->name('home');


//blog
//Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'gust'],function (){
//    Route::get("/auth/","IndexController@index");
//    Route::post('/auth/login','LoginController@postLogin');
//});
//账户管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth'],function (){
    Route::get('index','IndexController@index');
    Route::get('getUserList','AccountController@getlist');
    Route::post('deleteUser','AccountController@deleteaccount');
});

//管理员
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth'],function (){
    Route::get('getUserInfo','UserController@getuserinfo');
    Route::post('updateUserInfo','UserController@updateuserinfo');
});

