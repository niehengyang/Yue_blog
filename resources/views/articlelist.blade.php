@extends('layouts.app')
<!-- Styles -->
<link href="{{asset('css/home.css')}}" rel="stylesheet">
<style>
    .gtco-cover{
        background-image: url("/images/top1.jpg");
    }
</style>
@section('content')

    <!--头部-->
    <header id="gtco-header"  style="height: 400px; background-size: 100% 100%;" class="gtco-cover" role="banner" data-stellar-background-ratio="0.5">
    </header>

    <div class="container">
        <div class="row">
            <!--首页路径-->
            <div class="warp-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <a href="/">{{ config('app.name', 'laravel') }}</a>
                    </li>
                    <li><a href="/home">首页</a></li>
                    <li><a href="/classification/show">分类列表</a></li>
                    <li class="active">文章列表</li>
                </ul>
            </div>

            <!--文章列表-->
            <div class="row row-pb-md">
                <div class="col-md-12">
                    <ul id="gtco-post-list">
                    @if(!empty($articleList))
                        @foreach($articleList as $article)
                            <!--可通过改变class属性而改变文章卡片显示大小(full,two-third,one-third)-->
                                <li class="one-third entry animate-box" data-animate-effect="fadeIn">
                                    <a href="#">
                                        @if(!empty($article->img))
                                            <a class="permalink" href="{{route('article_show',array('id'=>$article->id))}}">
                                                <div class="entry-img"><img src="{{$article->img}}" /></div>
                                            </a>
                                        @endif
                                        <div class="entry-desc">
                                            <span class="category"><a href="{{route('article_list',array('id'=>$article->classification_id))}}">{{$article->classification_name}}</a></span>
                                            <h3><a href="{{route('article_show',array('id'=>$article->id))}}">{{$article->title}}</a></h3>
                                            <p>{!! $article->abstract !!}</p>
                                        </div>
                                        <div class="entry-footer clearfix">
                                            <div class="panel-heading">
                                                <div class="left">
                                                    <span class="title_span"><time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$article->created_at->format('d F,Y')!!}</time></span>
                                                    <span>|</span>
                                                    <a href="##" class="author_a">{{$article->author}}</a>
                                                </div>
                                                <a href="##" class="comments_span">{{$article->comments_number}}&nbsp;评论</a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
        </div>
            <div class="pagination_item">
                {{$articleList->links()}}
            </div>
    </div>
    </div>
 @endsection