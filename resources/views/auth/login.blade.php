@extends('layouts.adminltelogin')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <b>Admin</b>LTE
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        {{ Form::open(['url' => '/login']) }}
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Username']) }}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">    
                    <div class="checkbox icheck">
                        <label>
                            {{ Form::checkbox('remember') }} Remember Me
                        </label>
                    </div>                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                    {{ Form::submit('Sign In', ['class'=>'btn btn-primary btn-block btn-flat']) }}
                </div><!-- /.col -->
            </div>
        {{ Form::close() }}
        {{ Html::link('/password/reset', 'Forgot Your Password?') }}<br>
        {{ Html::link('/register', 'Register a new membership') }}

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@endsection
