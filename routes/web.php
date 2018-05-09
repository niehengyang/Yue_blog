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






//登录
Route::group(['middleware' => 'web'],function (){
    //前台使用默认登录框架
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    //后台管理员
    Route::get('admin/login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login','Admin\LoginController@postLogin');
    Route::get('admin/register','Admin\LoginController@getRegister');
    Route::post('admin/register','Admin\LoginController@register');
    Route::get('admin/logout','Admin\LoginController@logout');

    Route::get('admin/home','Admin\IndexController@index');//首页展示
});


//用户账户管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth.admin'],function (){
    Route::get('getUserList','AccountController@getlist');//获取账户列表
    Route::post('deleteUser','AccountController@deleteaccount');//删除账户
});

//管理员信息修改
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth.admin'],function (){
    Route::get('getUserInfo','UserController@getuserinfo');//获取管理员信息
    Route::post('updateUserInfo','UserController@updateuserinfo');//修改管理员信息
    Route::post('resetpwd','UserController@resetpwd');//修改密码
});

//文章管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth.admin'],function (){
   Route::get('getList','ArticleController@index');//获取文章列表
   Route::post('batchDelArticle','ArticleController@delarticle');//批量删除
   Route::post('initArticle','ArticleController@store');//初始化文章
   Route::post('uploadfile','ArticleController@upload');//上传图片
   Route::post('publishedarticle','ArticleController@published');//发表
   Route::post('commentslist','ArticleController@getcommentslist');//获取评论列表
});

//分类管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth.admin'],function (){
    Route::get('classificationList','classificationController@index');//获取文章分类列表
    Route::post('initclassification','classificationController@store');//初始化分类
    Route::post('delclassification','classificationController@deltype');//删除分类
});

//评论管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'auth.admin'],function (){
    Route::get('commentslist','commentsController@getcommentslist');//获取评论列表
    Route::post('disablecomments','commentsController@disableFun');//禁用评论
    Route::post('delcomments','commentsController@delcomments');//删除评论
    Route::post('initcomments','commentsController@createComments');//生成评论
});