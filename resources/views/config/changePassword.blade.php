@extends('layouts.adminlte')
@section('title', 'Change Password')
@section('content')
{{ Form::open(['method'=>'PATCH', 'url'=>'/changePassword/'.$user->id]) }}
	<div class="box box-success box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Change Password</h3>
		</div>
		<div class="box-body">
			@include('common.status')
            <div class="form-group has-feedback{{ $errors->has('old_password') ? ' has-error' : '' }}">
				{{ Form::label('old_password', 'Old Password') }}
                {{ Form::password('old_password', ['class'=>'form-control', 'placeholder'=>'Old Password']) }}
                @if ($errors->has('old_password'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
				{{ Form::label('password', 'New Password') }}
                {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'New Password']) }}
                @if ($errors->has('password'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				{{ Form::label('password_confirmation', 'Password Confirmation') }}
                {{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Password Confirmation']) }}
                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
		</div>
	</div>
	<div class="box box-success box-solid">
		<div class="box-body">
			<div class="form-actions">
                {{ Form::submit('Save', ['class'=>'btn btn-primary btn-flat pull-right']) }}
	        </div>
	    </div>
	</div>
{{ Form::close() }}
@endsection