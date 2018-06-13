@extends('layouts.app')
<!-- Styles -->
<link href="{{asset('css/category.css')}}" rel="stylesheet">
<style>
    .gtco-cover{
        background-image: url("/images/top1.jpg");
    }
</style>
<script type="text/javascript">

</script>
@section('content')
    <!--头部-->
    <header id="gtco-header"  style="height: 400px; background-size: 100% 100%;" class="gtco-cover" role="banner" data-stellar-background-ratio="0.5">
    </header>
    <div id="gtco-main">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12">
            {{--<!--首页路径-->--}}
            {{--<div class="warp-breadcrumb">--}}
                {{--<ul class="breadcrumb">--}}
                    {{--<li>--}}
                        {{--<a href="/">{{ config('app.name', 'laravel') }}</a>--}}
                    {{--</li>--}}
                    {{--<li><a  href="/home">首页</a></li>--}}
                    {{--<li class="active">分类列表</li>--}}
                {{--</ul>--}}
            {{--</div>--}}

            <!--分类列表-->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
                <div class="tm-blog-post">
                    <h3 class="tm-gold-text">置顶文章</h3>
                    <ul id="gtco-post-list">
                    @if(!empty($popular_articleList))
                        @foreach($popular_articleList as $popular_article)
                            <!--可通过改变class属性而改变文章卡片显示大小(full,two-third,one-third)-->
                                <li class="two-third entry animate-box" data-animate-effect="fadeIn">
                                    <a href="#">
                                        @if(!empty($popular_article->img))
                                            <a class="permalink" href="{{route('article_show',array('id'=>$popular_article->id))}}">
                                                <div class="entry-img"><img src="{{$popular_article->img}}" /></div>
                                            </a>
                                        @endif
                                        <div class="entry-desc">
                                            <span class="category"><a href="{{route('article_list',array('id'=>$popular_article->classification_id))}}">{{$popular_article->classification_name}}</a></span>
                                            <h3><a href="{{route('article_show',array('id'=>$popular_article->id))}}">{{$popular_article->title}}</a></h3>
                                            <p>{!! $popular_article->abstract !!}</p>
                                        </div>
                                        <div class="entry-footer clearfix">
                                            <div class="panel-heading" style="padding: 0px 50px;">
                                                <div class="left">
                                                    <span class="title_span"><time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$popular_article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$popular_article->created_at->format('d F,Y')!!}</time></span>
                                                    <span>|</span>
                                                    <a href="##" class="author_a">{{$popular_article->author}}</a>
                                                </div>
                                                <a href="##" class="comments_span">{{$popular_article->comments_number}}&nbsp;评论</a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <aside class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 tm-aside-r">
                <div class="tm-aside-container">
                    <h3 class="tm-gold-text tm-title">文章分类</h3>
                    <nav>
                        <ul class="nav">
                            @if(!empty($classifications))
                                @foreach($classifications as $classification)
                                    <li>
                                        <a href="{{route('article_list',array('id'=>$classification->id))}}" class="tm-text-link">{{$classification->name}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                    <hr class="tm-margin-t-small">
                    <h3 class="tm-gold-text tm-title tm-margin-t-small">有用的链接</h3>
                    <nav>
                        <ul class="nav">
                            <li>
                                <a href="https://www.meiwen.com.cn/" class="tm-text-link">美文阅读网</a>
                            </li>
                            <li>
                                <a href="http://www.duwenzhang.com/" class="tm-text-link">文章阅读网</a>
                            </li>
                            <li>
                                <a href="http://www.17k.com/" class="tm-text-link">17K小说网</a>
                            </li>
                            <li>
                                <a href="https://www.qidian.com/" class="tm-text-link">起点中文网</a>
                            </li>
                            <li>
                                <a href="https://www.sanwen.net/" class="tm-text-link">散文网</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!--文章列表-->

        </div>
            </div>
    </div>
    </div>
@endsection