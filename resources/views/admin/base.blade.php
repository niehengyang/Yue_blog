<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yue_blog</title>
    <link rel="stylesheet" href="">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="header_title"><h1>Yue_blog</h1></div>
        <div class="panel panel-default">
            @yield('content')
        </div>
    </div>
</div>
<!-- Footer -->
<footer id="footer">
    {{--<div class="container">--}}
        {{--<ul class="icons">--}}
            {{--<li><a href="#" class="fa fa-twitter"><span class="label">Twitter</span></a></li>--}}
            {{--<li><a href="#" class="fa fa-facebook"><span class="label">Facebook</span></a></li>--}}
            {{--<li><a href="#" class="fa fa-instagram"><span class="label">Instagram</span></a></li>--}}
            {{--<li><a href="#" class="fa fa-envelope"><span class="label">Email</span></a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    <div class="copyright">
        Copyright &copy; 2018.niehengyang123@163.com.<a target="_blank" href="##"></a>
    </div>
</footer>
</body>
</html>