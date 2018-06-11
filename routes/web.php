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
        return redirect('home');
    }else{
        return view('/websitedown');
    }
})->middleware('auth');
Auth::routes();




//前台页面
Route::group(['middleware' => 'web'],function (){
    //前台使用默认登录框架
        Route::get('home', 'HomeController@index')->name('home');//前台首页
        Route::get('article/show','ArticleController@index')->name('article_show');//前台文章页面
        Route::get('comments/index','CommentController@index')->name('comments_index');
        Route::post('comments/store','CommentController@store')->name('comments_store');//评论创建
        Route::post('comments/reply','CommentController@replyComments')->name('reply_comment');//回复评论
        Route::get('comments/destroy','CommentController@destroy')->name('comments_destroy');//评论删除
        Route::get('categorylist','ClassificationController@index')->name('classifications_show');//分类列表
        Route::get('articlelist','ArticleController@getlist')->name('article_list');//文章列表

//    Route::get('trypage','HomeController@tryPage');
});

//前台页面首页
Route::group(['middleware' => 'web'],function (){
    Route::get('popular_article','HomeController@get_popularArticle')->name('popularArticle');
});
