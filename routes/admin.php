<?php
//后台管理员登录

Route::get('/',function (){
   return view('admin.index');
})->middleware('auth.admin');

Route::get('/login','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/login','Admin\LoginController@postLogin');//登录
Route::get('/register','Admin\LoginController@getRegister')->name('admin.register');
Route::post('/register','Admin\LoginController@register')->name('admin.register');//注册
Route::get('/password_request','Admin\LoginController@showLinkRequestForm')->name('forgetPassword');//忘记密码
Route::post('/password_request','Admin\LoginController@passwordRequest')->name('passwordRequest');
Route::get('/resetpwd','Admin\LoginController@showResetPwdForm')->name('admin.resetpwd');
Route::post('/resetpwd','Admin\LoginController@resetPwd')->name('resetpwd');//重置密码
Route::post('/logout','Admin\LoginController@logout');//退出
Route::get('/home','Admin\IndexController@index');//首页展示

//用户账户管理
    Route::get('/getUserList','Admin\AccountController@getList');//获取账户列表
    Route::post('/deleteUser','Admin\AccountController@deleteAccount');//删除账户


//管理员信息修改
    Route::get('/getUserInfo','Admin\AdminController@getuserinfo');//获取管理员信息
    Route::post('/updateUserInfo','Admin\AdminController@updateuserinfo');//修改管理员信息
    Route::post('/resetpwd','Admin\AdminController@resetpwd');//修改密码


//文章管理
    Route::get('/getList','Admin\ArticleController@index');//获取文章列表
    Route::post('/batchDelArticle','Admin\ArticleController@delarticle');//批量删除
    Route::post('/initArticle','Admin\ArticleController@store');//初始化文章
    Route::post('/uploadfile','Admin\ArticleController@upload');//上传图片
    Route::post('/deletepicture','Admin\ArticleController@deletePicture');//删除图片
    Route::post('/publishedarticle','Admin\ArticleController@published');//发表
    Route::post('/commentslist','Admin\ArticleController@getcommentslist');//获取评论列表


//分类管理

    Route::get('/classificationList','Admin\classificationController@index');//获取文章分类列表
    Route::post('/initclassification','Admin\classificationController@store');//初始化分类
    Route::post('/delclassification','Admin\classificationController@deltype');//删除分类


//评论管理

    Route::get('/commentslist','Admin\commentsController@getcommentslist');//获取评论列表
    Route::post('/disablecomments','Admin\commentsController@disableFun');//禁用评论
    Route::post('/delcomments','Admin\commentsController@delcomments');//删除评论
    Route::post('/initcomments','Admin\commentsController@createComments');//生成评论


//图片管理

    Route::get('/imagelist','Admin\imageController@getimagelist');//获取图片列表
    Route::post('/replace_picture','Admin\imageController@replacepicture');//图片修改
    Route::post('/deleteimage','Admin\imageController@deletePicture');//删除图片


//网站管理

    Route::post('/isdownwebsite','Admin\siteupdateController@shotdownwebsite');//关闭网站
    Route::get('/getdeskpageinfo','Admin\siteupdateController@getdeskpageinfo');//获取页面信息
    Route::post('/deskpageupdate','Admin\siteupdateController@deskpageupdate');//前台页面修改
