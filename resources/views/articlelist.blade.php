@extends('layouts.app')

@section('content')
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
            <div class="main-content-area">
                <div class="container post-listing">
                    <div class="row is-flex">
                        @if(!empty($articleList))
                            @foreach($articleList as $article)
                                <div class="col-sm-6 col-md-4 col-xs-12">
                                    <article class="post post-card">
                                        @if(!empty($article->img))
                                            <a class="permalink" href="{{route('article_show',array('id'=>$article->id))}}">
                                                <div class="featured-image"><img style="position: center" src="{{$article->img}}"/></div>
                                            </a>
                                        @endif
                                        <div class="content-warp">
                                            <div class="entry-header align-center">
                                                <span class="category"><a href="{{route('article_list',array('id'=>$article->classification_id))}}">{{$article->classification_name}}</a></span>
                                                <h2 class="title h4"><a href="{{route('article_show',array('id'=>$article->id))}}">{{$article->title}}</a></h2>
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
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        @endif
                        {{--@if(!empty($articleList))--}}
                        {{--@foreach($articleList as $article)--}}
                        {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading">--}}
                        {{--<div class="panel-heading left">--}}
                        {{--<span class="title_span"><time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$article->created_at->format('d F,Y')!!}</time></span>--}}
                        {{--<span>|</span>--}}
                        {{--<a href="##" class="author_a">{{$article->author}}</a>--}}
                        {{--</div>--}}
                        {{--<a href="##" class="comments_span">{{$article->comments_number}}&nbsp;评论</a>--}}
                        {{--</div>--}}

                        {{--<div class="panel-body">--}}
                        {{--<div class="title_item">--}}
                        {{--<san><h3>{{$article->title}}</h3></san>--}}
                        {{--</div>--}}
                        {{--<div class="abstract_item">--}}
                        {{--<span>{!! $article->abstract !!}<a href="{{route('article_show',array('id'=>$article->id))}}">查看全文</a></span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
                    </div>
                    {{--<div class="pagination_item">--}}
                        {{--{{$articleList->links()}}--}}
                    {{--</div>--}}
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
 @endsection