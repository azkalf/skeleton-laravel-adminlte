@extends('layouts.adminlte')
@section('title', 'User Configuration')
@section('content')
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Manage User</h3>
	</div>
	<div class="box-body">
		@include('common.status')
		{{ Html::link('/user/create', 'Create User', ['class'=>'btn btn-flat btn-primary pull-right']) }}
		<br><br><br>
		<table class="table table-bordered table-striped" id="users-table">
		    <thead>
		        <tr>
		            <th width="60px"></th>
		            <th>Username</th>
		            <th>Full Name</th>
		            <th>Email</th>
		            <th>Sex</th>
		            <th>Group</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		    	@if (count($users) > 0)
			    	@foreach($users as $user)
			    		<?php $photo = empty($user->photo) ? ($user->sex == 'm' ? 'ikhwan.png' : 'akhwat.png') : $user->photo; ?>
			    		<tr>
			    			<td>{{ Html::image(url('/images/'.$photo), $user->name.' photo') }}</td>
			    			<td>{{ $user->name }}</td>
			    			<td>{{ $user->fullname }}</td>
			    			<td>{{ $user->email }}</td>
			    			<td>{{ $user->sex }}</td>
			    			<td>{{ $user->group->group_name }}</td>
			    			<td width="30">
				    			{{ Form::open(['method'=>'DELETE', 'url'=>'user/'.$user->id]) }}
				    			<a href="#" class="delete" data-original-title="Delete" data-toggle="tooltip" onclick="delUser(this);"><i class="glyphicon glyphicon-trash"></i></a>
				    			{{ Form::close() }}
			    			</td>
			    		</tr>
			    	@endforeach
			    @else
			    	<tr>
			    		<td class="empty" colspan="8"><i>No result found.</i></td>
			    	</tr>
			    @endif
		    </tbody>
		</table>
		<div class="pull-right">
		{{ $users->links() }}
		</div>
    </div>
</div>
@endsection
@push('style')
<style type="text/css">
	table img{
		width: 50px;
		height: 50px;
	}
</style>
@endpush
@push('script')
<script type="text/javascript">
	var delUser = function(obj) {
		confirm('Are you sure want to delete this User?');
		jQuery(obj).closest('form').submit();
	}
</script>
@endpush