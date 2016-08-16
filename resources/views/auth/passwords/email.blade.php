@extends('layouts.adminltelogin')

<!-- Main Content -->
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div><!-- /.login-logo -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                    </button>
                </div><!-- /.col -->
            </div>
        </form>
        <a href="{{ url('/login') }}">Login</a>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection
