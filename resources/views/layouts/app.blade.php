<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'laravel') }}</title>

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
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        {{--<li></li>--}}
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
                    <span class="speak_title"><h2>HELLO,I AM NHY</h2></span>
                    <span class="describe_title">Yue_blog是一个基于laravel5开发的博客系统</span>
                    <a href="/home"><button class="go_home">HOME</button></a>
                </div>

            </div>
        </nav>

        @yield('content')
    </div>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
