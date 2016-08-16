@extends('layouts.adminlte')
@section('title', 'Group Configuration')
@section('content')
{{ Form::model($group, ['method'=>'POST', 'url'=>'/group']) }}
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Create Group</h3>
	</div>
	<div class="box-body">
		@include('common.status')
		@include('config.group_form')
    </div>
</div>
{{ Form::close() }}
@endsection
@include('common.treeview')