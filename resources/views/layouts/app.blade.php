<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! config('app.name', 'Laravel') !!}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/home.css')}}" rel="stylesheet">
    <style>
        .navbar{
            width: 100%;
            height: 300px;
            background: url("{{config('app.home_background','/images/Yue_blog.jpg')}}");
            background-size: 100% 100%;
        }
        .warp_title{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
        }
        .speak_title{
            font-family: "Courier New", monospace;
        }
        .describe_title{
            font-family: Aharoni;
            font-style: italic;
        }
        nav a{
        display: block;
        }
        summary{
            cursor: pointer;
        }
        .go_home{
            border: 1px solid #dddddd;
            text-align: center;
            margin: 10px;
            width: 60px;
            height: 30px;
            background: none;
            color: #dddddd ;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" style="color: white" href="{{ url('/') }}">
                        {!! config('app.name', 'Laravel') !!}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        <li class="details_item"><a href="/home">首页</a></li>
                        <li class="details_item"><a href="{{route('classifications_show')}}">文章分类</a></li>
                        <li class="details_item"><a href="">作者档案</a></li>
                        <li class="details_item"><a href="">关于</a></li>
                        <li class="details_item"><a href="">联系</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!--route Links-->
                        {{--<li class="details_item">--}}
                           {{----}}
                        {{--</li>--}}
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" style="color: white" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->nickname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            退出
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="warp_title">
                    <span class="speak_title"><h2 style="color: #f5f8fa">{!! config('app.speak', 'Laravel') !!}</h2></span>
                    <span class="describe_title" >{!! config('app.describe', 'Laravel') !!}</span>
                </div>

            </div>
        </nav>
        @yield('content')
    </div>
    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <ul class="icons">
                <li><a href="#" class="fa fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="fa fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="fa fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="fa fa-envelope"><span class="label">Email</span></a></li>
            </ul>
        </div>
        <div class="copyright">
            Copyright &copy; 2018.niehengyang123@163.com.<a target="_blank" href="##"></a>
        </div>
    </footer>
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
                $("#comment_textarea").focus();
                $("#comment_textarea").val(function () {
                return '回复'+$(".reply_btn").attr("data-commentuser")+':'
                });
                $(".reply_parentId").attr("value",function () {
                    return  ($(".reply_btn").attr("data-commentId"));
                });

            });
        });

    </script>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
