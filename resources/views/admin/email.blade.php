@extends('admin.base')

@section('content')
    <div><h3 class="panel-heading">重置邮件</h3></div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('passwordRequest') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {{--<label for="email" class="col-md-4 control-label">邮箱地址</label>--}}

                <div class="email_item col-md-6">
                    <input id="email" type="email" class="form-control" placeholder="请输入邮箱地址" name="email" value="{{ old('email') }}" required>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        发送重置
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection