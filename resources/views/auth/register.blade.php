@extends('layouts.adminltelogin')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <b>Admin</b>LTE
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Register a new membership</p>
        {{ Form::open() }}
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Username']) }}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('fullname') ? ' has-error' : '' }}">
                {{ Form::text('fullname', old('fullname'), ['class'=>'form-control', 'placeholder'=>'Full Name']) }}
                <span class="glyphicon glyphicon-font form-control-feedback"></span>
                @if ($errors->has('fullname'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('fullname') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('sex') ? ' has-error' : '' }}">
                {{ Form::select('sex', ['m'=>'Male', 'f'=>'Female'], 'm', ['class'=>'form-control', 'style'=>'-moz-appearance:none;-webkit-appearance:none;appearance:none;']) }}
                <span class="glyphicon glyphicon-heart form-control-feedback"></span>
                @if ($errors->has('sex'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('sex') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                {{ Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Email']) }}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                {{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Password Confirmation']) }}
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <hr>
            <div class="form-group has-feedback{{ $errors->has('company_name') ? ' has-error' : '' }}">
                {{ Form::text('company_name', old('company_name'), ['class'=>'form-control', 'placeholder'=>'Company Name']) }}
                <span class="glyphicon glyphicon-building form-control-feedback"></span>
                @if ($errors->has('company_name'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('company_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('company_address') ? ' has-error' : '' }}">
                {{ Form::text('company_address', old('company_address'), ['class'=>'form-control', 'placeholder'=>'Company Address']) }}
                <span class="glyphicon glyphicon-road form-control-feedback"></span>
                @if ($errors->has('company_address'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('company_address') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('company_email') ? ' has-error' : '' }}">
                {{ Form::text('company_email', old('company_email'), ['class'=>'form-control', 'placeholder'=>'Company Email']) }}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('company_email'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('company_email') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="row">
                <div class="col-xs-8">
                </div><!-- /.col -->
                <div class="col-xs-4">
                    {{ Form::submit('Register', ['class'=>'btn btn-primary btn-block btn-flat']) }}
                </div><!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/login') }}">I already have a membership</a>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection
