<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Free HTML5 Website Template by GetTemplates.co"/>
        <meta name="keywords" content="free website templates,free html5,free template,free bootstrap,free website template,html5,css3,mobile first,responsive"/>
        <meta name="author" content="GetTemplates.co">
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}" />
        <title>{{ config('app.name', 'laravel') }}</title>

        <!-- Fonts -->
        {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}

        <!-- Styles -->
        <style>
            {{--.gtco-cover{--}}
                {{--background: url("{{'/images/welcome.jpg'}}");--}}
                {{--background-position: -25px 0px;--}}
            {{--}--}}
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

            <header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url('/images/welcome.jpg');" data-stellar-background-ratio="0.5">
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
                                        {{--<a href="#" class="text-link">NHY</a>--}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="copyrights">

            </div>

        </div>
    <!-- Scripts -->

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/welcome.js')}}"></script>
    </body>
</html>
