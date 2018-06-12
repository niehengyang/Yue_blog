<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Article;
use App\Model\classification;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $currentUser = Auth::user();
        $popular_article = $this->get_popularArticle();
        $classifications = $this->get_classifications();
        view()->share('popular_articleList',$popular_article);
        view()->share('classifications' ,$classifications);
        view()->share( 'currentUser', $currentUser);
//        view()->composer('footer',function($view){
//            $popular_article = $this->get_popularArticle();
//            $classifications = $this->get_classifications();
//            $view->with('popular_articleList',$popular_article);
//            $view->with('classifications' ,$classifications);
//        });
    }

    public function get_popularArticle(){
        $popular_article = Article::where('istop',1)->get();
        return $popular_article;
    }

    public function get_classifications(){
        $classifications = classification::all();
        return $classifications;
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
