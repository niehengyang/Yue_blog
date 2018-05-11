<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/main.css')}}" />
        <title>Yue_blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            #header > .logo a {
                font-size: 4rem;
                font-weight: 700;
                color: #FFF;
                text-decoration: none;
                line-height: 3rem;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: -50px;
            }

            .content {
                background-color: #ffffff;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
    <!--操作栏-->
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">主页</a>
                    @else
                        <a href="{{ url('/login') }}">请登录</a>
                        <a href="{{ url('/register') }}">注册</a>
                    @endif
                </div>
            @endif
        </div>

            <!-- Header -->
            <header id="header">
                <div class="logo"><a href="#">Yue_blog<span>by NHY</span></a></div>
            </header>

        <!--文章列表-->
        <div class="content_box">
        <!-- One 置顶文章-->
        <section id="one" class="wrapper style1">
            <div class="image fit flush">
                <img src="images/pic02.jpg" alt="" />
            </div>
            <header class="special">
                <h2>Fringilla Fermentum Tellus</h2>
                <p>vehicula urna sed justo bibendum</p>
            </header>
            <div class="content">
                <p>Curabitur eget semper ante. Morbi eleifend ultricies est, a blandit diam vehicula vel. Vestibulum porttitor nisi quis viverra hendrerit. Suspendisse vel volutpat nibh, vel elementum lacus. Maecenas commodo pulvinar dui, at cursus metus imperdiet vel. Vestibulum et efficitur urna. Duis velit nulla, interdum sed felis sit amet, facilisis auctor nunc. Cras luctus urna at risus feugiat scelerisque nec sed diam. </p>
                <p>Nunc fringilla metus odio, at rutrum augue tristique vel. Nulla ac tellus a neque ullamcorper porta a vitae ipsum. Morbi est sapien, hendrerit quis mi in, aliquam bibendum orci. Vestibulum imperdiet nibh vitae maximus posuere. Aenean sit amet nibh feugiat, condimentum tellus eu, malesuada nunc. Mauris ac pulvinar turpis, sit amet pharetra est. Ut bibendum justo condimentum, vehicula ex vel, venenatis libero. Etiam vehicula urna sed justo bibendum, ac lacinia nunc pulvinar. Integer nec velit orci. Vestibulum pellentesque varius dapibus. Morbi ullamcorper augue est, sed luctus orci fermentum dictum. Nunc tincidunt, nisl consequat convallis viverra, metus nisl ultricies dui, vitae dapibus ligula urna sit amet nibh. Duis ut venenatis enim.</p>
            </div>
        </section>

            <!-- Two 图片区-->
            <section id="two" class="wrapper style2">
                <header>
                    <h2>Stay before every beautiful thoughts</h2>
                    <p>在每一个美好的思想前停留</p>
                </header>
                <div class="content">
                    <div class="gallery">
                        <div>
                            <div class="image fit flush">
                                <a href="/storage/2018-05-08-01-58-34.jpg"><img src="/storage/2018-05-08-01-58-34.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div>
                            <div class="image fit flush">
                                <a href="/storage/2018-05-11-05-56-57.jpg"><img src="/storage/2018-05-11-05-56-57.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div>
                            <div class="image fit flush">
                                <a href="/storage/2018-05-11-05-56-07.jpg"><img src="/storage/2018-05-11-05-56-07.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div>
                            <div class="image fit flush">
                                <a href="/storage/2018-05-11-05-58-34.jpg"><img src="/storage/2018-05-11-05-58-34.jpg" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Three 列表区-->

            <section id="three" class="wrapper">
                @if(!empty($articleList))
                    @foreach($articleList['data'] as $article)
                    <div class="spotlight">
                        {{--<div class="image flush"><img src="images/pic06.jpg" alt="" /></div>--}}
                        <div class="image flush"><img src="{{$article->img}}" alt="" /></div>
                        <div class="inner">
                            <h3>{{$article->title}}</h3>
                            <p>{{$article->created_at}}</p>
                            <p>{{$article->content}}</p>
                        </div>
                    </div>
                {{--<div class="spotlight alt">--}}
                    {{--<div class="image flush"><img src="images/pic07.jpg" alt="" /></div>--}}
                    {{--<div  class="inner">--}}
                        {{--<h3>Curabitur Eget</h3>--}}
                        {{--<p>Curabitur eget semper ante. Morbi eleifend ultricies est, a blandit diam vehicula vel. Vestibulum porttitor nisi quis viverra hendrerit. Suspendisse vel volutpat nibh, vel elementum lacus. Maecenas commodo pulvinar dui, at cursus metus imperdiet vel.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="spotlight">--}}
                    {{--<div class="image flush"><img src="images/pic08.jpg" alt="" /></div>--}}
                    {{--<div class="inner">--}}
                        {{--<h3>Morbi Eleifend</h3>--}}
                        {{--<p>Curabitur eget semper ante. Morbi eleifend ultricies est, a blandit diam vehicula vel. Vestibulum porttitor nisi quis viverra hendrerit. Suspendisse vel volutpat nibh, vel elementum lacus. Maecenas commodo pulvinar dui, at cursus metus imperdiet vel.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                    @endforeach
                @endif
            </section>
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
                Copyright &copy; 2018.niehengyang@163.com.<a target="_blank" href="##"></a>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
        <script src="{{asset('js/skel.min.js')}}"></script>
        <script src="{{asset('js/util.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>

    </body>
</html>
