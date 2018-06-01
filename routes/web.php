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
    if (\App\Model\Deskpageinfo::find(1)->web_release_size){
        return redirect('/home');
    }else{
        return view('/websitedown');
    }
});
Auth::routes();




//前台页面
Route::group(['middleware' => 'web'],function (){
    //前台使用默认登录框架
    if (\App\Model\Deskpageinfo::find(1)->web_release_size){
        Route::get('/home', 'HomeController@index')->name('home');//前台首页
        Route::get('/article/show','ArticleController@index')->name('article_show');//前台文章页面
        Route::get('/comments/index','CommentController@index')->name('comments_index');
        Route::post('/comments/store','CommentController@store')->name('comments_store');//评论创建
        Route::post('/comments/reply','CommentController@replyComments')->name('reply_comment');//回复评论
        Route::get('/comments/destroy','CommentController@destroy')->name('comments_destroy');//评论删除
        Route::get('/classification/show','ClassificationController@index')->name('classifications_show');//分类列表
        Route::get('/articlelist','ArticleController@getlist')->name('article_list');//文章列表
    }else{
        return view('/websitedown');
    }
});




//后台管理员登录
Route::group(['prefix' => 'admin','middleware' => 'web' ],function (){
    Route::get('/',function (){
        return redirect('admin/home');
    });
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\LoginController@postLogin');//登录
    Route::get('register','Admin\LoginController@getRegister')->name('admin.register');
    Route::post('register','Admin\LoginController@register')->name('register');//注册
    Route::get('password_request','Admin\LoginController@showLinkRequestForm')->name('password.request');//忘记密码
    Route::post('password_request','Admin\LoginController@passwordRequest')->name('passwordRequest');
    Route::get('resetpwd','Admin\LoginController@showResetPwdForm')->name('admin.resetpwd');
    Route::post('resetpwd','Admin\LoginController@resetPwd')->name('resetpwd');//重置密码
    Route::post('logout','Admin\LoginController@logout');//退出
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

//图片管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
    Route::get('imagelist','imageController@getimagelist');//获取图片列表
    Route::post('replace_picture','imageController@replacepicture');//图片修改
    Route::post('deleteimage','imageController@deletePicture');//删除图片
});

//网站管理
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin','middleware' => 'web'],function (){
    Route::post('isdownwebsite','siteupdateController@shotdownwebsite');//关闭网站
    Route::get('getdeskpageinfo','siteupdateController@getdeskpageinfo');//获取页面信息
    Route::post('deskpageupdate','siteupdateController@deskpageupdate');//前台页面修改
});