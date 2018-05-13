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




//前台登录
Route::group(['middleware' => 'web'],function (){
    //前台使用默认登录框架
    Route::get('/home', 'HomeController@index')->name('home');//前台首页
//    Route::get('/article','')
});




//后台管理员登录
Route::group(['prefix' => 'admin','middleware' => 'web' ],function (){
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\LoginController@postLogin');
    Route::get('register','Admin\LoginController@getRegister');
    Route::post('register','Admin\LoginController@register');
    Route::post('logout','Admin\LoginController@logout');
    Route::get('home','Admin\IndexController@index');//首页展示
});


//用户账户管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
    Route::get('getUserList','AccountController@getList');//获取账户列表
    Route::post('deleteUser','AccountController@deleteAccount');//删除账户
});

//管理员信息修改
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
    Route::get('getUserInfo','AdminController@getuserinfo');//获取管理员信息
    Route::post('updateUserInfo','AdminController@updateuserinfo');//修改管理员信息
    Route::post('resetpwd','AdminController@resetpwd');//修改密码
});

//文章管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
   Route::get('getList','ArticleController@index');//获取文章列表
   Route::post('batchDelArticle','ArticleController@delarticle');//批量删除
   Route::post('initArticle','ArticleController@store');//初始化文章
   Route::post('uploadfile','ArticleController@upload');//上传图片
   Route::post('deletepicture','ArticleController@deletePicture');//删除图片
   Route::post('publishedarticle','ArticleController@published');//发表
   Route::post('commentslist','ArticleController@getcommentslist');//获取评论列表
});

//分类管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
    Route::get('classificationList','classificationController@index');//获取文章分类列表
    Route::post('initclassification','classificationController@store');//初始化分类
    Route::post('delclassification','classificationController@deltype');//删除分类
});

//评论管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
    Route::get('commentslist','commentsController@getcommentslist');//获取评论列表
    Route::post('disablecomments','commentsController@disableFun');//禁用评论
    Route::post('delcomments','commentsController@delcomments');//删除评论
    Route::post('initcomments','commentsController@createComments');//生成评论
});