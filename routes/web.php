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
//登录
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth'],function (){
    Route::post('login','LoginController@postLogin');
    Route::post('logout','LoginController@logout');
    Route::get('index','IndexController@index');//首页展示

});

//用户账户管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth'],function (){
    Route::get('getUserList','AccountController@getlist');//获取账户列表
    Route::post('deleteUser','AccountController@deleteaccount');//删除账户
});

//管理员信息修改
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth'],function (){
    Route::get('getUserInfo','UserController@getuserinfo');//获取管理员信息
    Route::post('updateUserInfo','UserController@updateuserinfo');//修改管理员信息
    Route::post('resetpwd','UserController@resetpwd');//修改密码
});

//文章管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth'],function (){
   Route::get('getList','ArticleController@index');//获取文章列表
   Route::post('batchDelArticle','ArticleController@delarticle');//批量删除
   Route::post('initArticle','ArticleController@store');//初始化文章
   Route::post('uploadfile','ArticleController@upload');//上传图片
   Route::post('publishedarticle','ArticleController@published');//发表
});

