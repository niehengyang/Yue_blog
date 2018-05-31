@extends('admin.base')

@section('style')
@parent
    <style>

    </style>
@endsection

@section('content')
                <div><h3 class="panel-heading">管理员登录</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{url('/admin/login')}}">
                        {!! csrf_field() !!}
                        <div class="form-group{{$errors->has('account_number')? 'has-error':''}}">
                            <div class="account_item col-md-6">
                                <input class="form-control" type="text" name="account_number" placeholder="用户名" value="{{old('account_number')}}">
                                @if($errors->has('account_number'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('account_number')}}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{$errors->has('password')? 'has-error':''}}">
                            <div class="password_item col-md-6">
                                <input class="form-control" type="password" placeholder="密码" name="password">
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('password')}}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="login_btn_item">
                            <button class="btn btn-primary" type="submit">登录</button>
                            @if($errors->has('login_error'))
                                <span class="help-block">
                                    <strong>{{$errors->first('login_error')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="bottom_controll">
                        <div class="form-group">
                            <label class="login_pitch f1">
                                <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }} class="f1">
                                <div class="f1">&nbsp;记住密码</div>
                                <div class="clear"></div>
                            </label>
                        </div>

                            <div class="right_control">
                                <a href="{{ route('password.request') }}" class="forget_password">忘记密码</a>
                                <span>&nbsp;|&nbsp;</span>
                                <a href="{{route('admin.register')}}" class="registered">注册</a>
                            </div>
                        </div>
                    </form>
                </div>
@endsection