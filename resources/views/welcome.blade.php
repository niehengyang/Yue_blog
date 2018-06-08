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
                            <div id="gtco-logo"><a href="trypage">Yue_blog<span>.</span></a></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li><a href="home">HOME</a></li>
                                <li><a href="/category">ABOUT</a></li>
                                <li><a href="/category">THEME</a></li>
                                <li><a href="/category">BLOG</a></li>
                                <li><a href="/category">CONTACT</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

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
                                    {{--<p>--}}
                                        {{--<a href="#" class="text-link">NHY</a>--}}
                                    {{--</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="copyrights"></div>

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
            <footer>
                <div class="wrap-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-footer col-md-3">
                                <h2 class="footer-title">
                                    <p>关于我们</p>
                                </h2>
                                <div class="textwidget">
                                    <p>这是关于我们的描述，想要了解更多请关注我们！！</p>
                                </div>
                            </div>
                            <div class="col-footer col-md-3 widget_recent_entries">
                                <h2 class="footer-title">
                                    <p>最受欢迎的帖子</p>
                                    <ul></ul>
                                </h2>
                            </div>
                            <div class="col-footer col-md-3">
                                <h2 class="footer-title">
                                    <p>新闻信</p>
                                </h2>
                                <p style="vertical-align: inherit;">如果您想收到我们的最新消息直接发送到您的电子邮箱，请在下面留下您的电子邮件地址。订阅式免费的，您可以随时取消。</p>
                                <form action="#" method="post">
                                    <input type="text" name="your-name" value size="40" placeholder="您的邮箱">
                                    <p style="vertical-align: inherit">
                                        <input type="submit" value="订阅" class="btn btn-skin">
                                    </p>
                                </form>
                            </div>
                            <div class="col-footer col-md-3">
                                <h2 class="footer-title">
                                    <p>分类</p>
                                </h2>
                                <div class="footer-tags">
                                    <a href="#">动物</a>
                                    <a href="#">烹饪</a>
                                    <a href="#">国家</a>
                                    <a href="#">城市</a>
                                    <a href="#">儿童</a>
                                    <a href="#">家庭</a>
                                    <a href="#">照片</a>
                                    <a href="#">购物</a>
                                    <a href="#">爱</a>
                                    <a href="#">学校</a>
                                    <a href="#">媒体</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <p>@1999-2008 CSDN版权所有</p>
                                <p>京ICP证09002463号</p>
                            </div>
                            <div class="col-md-4">
                                <ul class="list-inline social-buttons">
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul>
                                    <li><a href="#">隐私政策</a></li>
                                    <li><a href="#">使用条款</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
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
