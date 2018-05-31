@extends('admin.base')


@section('style')
    @parent
    <style>

    </style>
@endsection

@section('content')
    <div><h3 class="panel-heading">欢迎注册</h3></div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {!! csrf_field() !!}

            <div class="form-group{{$errors->has('account_number')? 'has-error':''}}">
                <div class="account_item col-md-6" style="margin-top: unset">
                    <input class="form-control" type="text" style="height: 30px" name="account_number" placeholder="用户名" value="{{old('account_number')}}" required autofocus>
                    @if($errors->has('account_number'))
                        <span class="help-block">
                            <strong>{{$errors->first('account_number')}}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{$errors->has('password')? 'has-error':''}}">
                <div class="password_item col-md-6" style="margin-top: unset">
                    <input class="form-control" type="password" style="height: 30px" placeholder="密码" name="password" required>
                    @if($errors->has('password'))
                        <span class="help-block">
                            <strong>{{$errors->first('password')}}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{$errors->has('password')? 'has-error':''}}">
                <div class="password_item col-md-6" style="margin-top: unset">
                    <input type="password" class="form-control" style="height: 30px" placeholder="确认密码" name="password_confirmation" required>
                    @if($errors->has('password'))
                        <span class="help-block">
                            <strong>{{$errors->first('password')}}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="name_item col-md-6" style="margin-top: unset">
                    <input id="name" type="text" class="form-control" style="height: 30px" name="name" placeholder="姓名" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                <div class="nickname_item col-md-6 " style="margin-top: unset">
                    <input id="nickname" type="text" class="form-control" style="height: 30px" name="nickname" placeholder="昵称" value="{{ old('nickname') }}" required autofocus>
                    @if ($errors->has('nickname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nickname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="email_item col-md-6 " style="margin-top: unset">
                    <input id="email" type="email" class="form-control" style="height: 30px" name="email" placeholder="邮箱" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="login_btn_item" style="margin-top: unset;padding: unset">
                    <a class="btn btn-primary btn-sm" style="width: unset;" type="submit">提交</a>
                    @if($errors->has('register_error'))
                        <span class="help-block">
                            <strong>{{$errors->first('register_error')}}</strong>
                        </span>
                    @endif
                    <a href="{{route('admin.login')}}" class="btn btn-success btn-sm" type="cancel">取消</a>
                </div>
            </div>

        </form>
    </div>
@endsection