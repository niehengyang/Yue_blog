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

    <!-- Styles -->
    <style>
        a{
            color: #337ab7;
            text-decoration: none;
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
                        <li><a href="/home">首页</a></li>
                        <li><a href="/category">关于</a></li>
                        <li><a href="/category">主题</a></li>
                        <li><a href="{{route('classifications_show')}}">博客</a></li>
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
                            <span class="data-post"></span>
                            <h1 class="mb30">
                                <a href="#">{{$article->title}}</a>
                            </h1>
                            <p>
                                <a href="#" class="text-link" style="font-family: '叶根友毛笔行书2.0版'">【{{$article->author}}】</a>
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
    @yield('content')
</div>
<!-- Footer -->
@include('footer',['popular_articleList' => $popular_articleList])
<script type="text/javascript">
    /**
     * 弹出式回复窗
     ***/
    {{--$(function() {--}}
        {{--$(".reply_btn").click(function () {--}}
            {{--$(".reply_textarea").remove();--}}
            {{--$(this).parent().parent().append("<div class='reply_textarea'><textarea id='reply_textarea' cols='50' rows='2'></textarea>" +--}}
                {{--"<br/><button id='reply_commit_btn'  data-commentuser='{{$comment->user_id}}' class='btn btn-primary btn-xs'>提交</button></div>");--}}

        {{--});--}}

    {{--});--}}
    {{--$("#reply_commit_btn").on("click",function () {--}}
        {{--var comment_content =$("#reply_textarea").val();--}}
        {{--// var replyuserId = $("#reply_commit_btn").attr("data-replyuser");--}}
        {{--// var commentuserId = $("#reply_commit_btn").attr("data-commentuser");--}}
        {{--// alert($("#reply_textarea").val());--}}
        {{--alert( $(this).text() );--}}
    {{--})--}}


    /**
     * 返回@式回复窗
     * **/
    $(function() {
        $(".reply_btn").on('click',function () {
            var commentUser = $(this).attr("data-commentuser");
            var commentId = $(this).attr("data-commentId");
            $("#comment_textarea").focus();
            $("#comment_textarea").val(function () {
                return '回复'+commentUser+':'
            });
            $(".reply_parentId").attr("value",commentId);
        });
    });

</script>
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