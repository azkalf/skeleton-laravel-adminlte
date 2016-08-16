@extends('layouts.adminlte')
@section('title', 'User Configuration')
@section('content')
{{ Form::model($user, ['method'=>'PATCH', 'url'=>'/user']) }}
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Update User {{ $user->id }}</h3>
	</div>
	<div class="box-body">
		@include('common.status')
		@include('config.user_form')
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