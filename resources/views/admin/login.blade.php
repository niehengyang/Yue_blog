<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yue_blog</title>
    <link rel="stylesheet" href="">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div><h3 class="panel-heading">管理员登录</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                             {!! csrf_field() !!}

                            <div class="form-group{{$errors->has('account_number') ? 'has-error':''}}">
                                <label class="col-md-4 control-label">账号:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="account_number" value="{{old('account_number')}}">
                                    @if($errors->has('account_number'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('account_number')}}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('password') ? 'has-error' : ''}}">
                                <label class="col-md-4 control-label">密码:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                    @if($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('password')}}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">&nbsp;记住我
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>&nbsp;登录
                                    </button>
                                    @if($errors->has('login_error'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('login_error')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--<script type="text/javascript" src="/js/app.js"></script>--}}
</body>
</html>