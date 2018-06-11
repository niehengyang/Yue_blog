<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Free HTML5 Website Template by GetTemplates.co"/>
        <meta name="keywords" content="free website templates,free html5,free template,free bootstrap,free website template,html5,css3,mobile first,responsive"/>
        <meta name="author" content="GetTemplates.co">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}" />
        <title>{{ config('app.name', 'laravel') }}</title>

        <!-- Fonts -->
        {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}

        <!-- Styles -->
        <style>
            .gtco-cover{
                background: url("{{'/images/welcome.jpg'}}");
            }
        </style>
    </head>
    <body>
    <div class="gtco-loader"></div>
        <div id="page">
            <nav class="gtco-nav" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2 text-left">
                            <div id="gtco-logo"><a href="#">Yue_blog<span>.</span></a></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li><a href="home">首页</a></li>
                                <li><a href="/category">关于</a></li>
                                <li><a href="/category">主题</a></li>
                                <li><a href="/category">博客</a></li>
                                <li><a href="/category">联系</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <!--header-->
            <header id="gtco-header" class="gtco-cover" role="banner" data-stellar-background-ratio="0.5">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 text-left">
                            <div class="display-t">
                                <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                                    <span class="data-post">hello！</span>
                                    <h1 class="mb30">
                                        <a href="#">Yue_blog是一个基于laravel5开发的博客系统</a>
                                    </h1>
                                    <p>
                                        <a href="#" class="text-link">NHY</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mouse-icon margin-20">
                        <div class="scroll"></div>
                    </div>
                </div>
            </header>
            {{--<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel" data-interval="4000">--}}
            {{--<!--滚动头部-->--}}
            {{--<div class="carousel-inner">--}}
                {{--@if(!empty($popular_articleList))--}}
                    {{--@foreach($popular_articleList as $popular_article)--}}
                        {{--@if($popular_article[0])--}}
                        {{--<div class="item active">--}}
                            {{--<img src="{{$popular_article->img}}" alt="...">--}}
                            {{--<div class="container">--}}
                                {{--<div class="header-text hidden-xs">--}}
                                    {{--<div class="col-md-12 text-center">--}}
                                        {{--<h1>{{$popular_article->title}}</h1>--}}
                                        {{--<hr>--}}
                                        {{--<p>{!! $popular_article->abstract !!}</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@endif--}}
                            {{--<div class="item">--}}
                                {{--<img src="{{$popular_article->img}}" alt="...">--}}
                                {{--<div class="container">--}}
                                    {{--<div class="header-text hidden-xs">--}}
                                        {{--<div class="col-md-12 text-center">--}}
                                            {{--<h1>{{$popular_article->title}}</h1>--}}
                                            {{--<hr>--}}
                                            {{--<p>{!! $popular_article->abstract !!}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                    {{--@endforeach--}}
                {{--@else--}}
                        {{--<div class="item active">--}}
                            {{--<img src="/images/welcome.jpg" alt="...">--}}
                            {{--<div class="container">--}}
                                {{--<div class="header-text hidden-xs">--}}
                                    {{--<div class="col-md-12 text-center">--}}
                                        {{--<h1>暂无推荐</h1>--}}
                                        {{--<hr>--}}
                                        {{--<p>多谢您的光临！！</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}
                {{--<!--控制按钮-->--}}
                {{--<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">--}}
                    {{--<span class="glyphicon glyphicon-chevron-left"></span>--}}
                {{--</a>--}}
                {{--<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">--}}
                    {{--<span class="glyphicon glyphicon-chevron-right"></span>--}}
                {{--</a>--}}
        {{--</div>--}}

            <div class="copyrights"></div>
            <!--main-->
            <div id="gtco-main">
                <div class="container">
                    <div class="row row-pb-md">
                        <div class="col-md-12">
                            <ul id="gtco-post-list">
                                @if(!empty($articleList))
                                    @foreach($articleList as $article)
                                        <!--可通过改变class属性而改变文章卡片显示大小(full,two-third,one-third)-->
                                <li class="{{$article->id%2 === 0? 'two-third':'one-third'}} entry animate-box" data-animate-effect="fadeIn">
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
                <div class="clear"></div>
            </div>

            <!--底部-->
            @include('footer',['popular_articleList' => $popular_articleList])
        </div>
    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
    </div>
    <!-- Scripts -->

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/welcome.js')}}"></script>
    </body>
</html>
