@extends('layouts.adminlte')
@section('title', 'Group Configuration')
@section('content')
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Manage Group</h3>
	</div>
	<div class="box-body">
		@include('common.status')
		{{ Html::link('/group/create', 'Create Group', ['class'=>'btn btn-flat btn-primary pull-right']) }}
		<br><br><br>
		<table class="table table-bordered table-striped" id="groups-table">
		    <thead>
		        <tr>
		            <th>Group Name</th>
		            <th colspan="2"></th>
		        </tr>
		    </thead>
		    <tbody>
		    	@if (count($groups) > 0)
			    	@foreach($groups as $group)
			    		<tr>
			    			<td>{{ $group->group_name }}</td>
			    			<td width="50">
				    			<a href="{{ url('group/'.$group->id.'/edit') }}" class="update" data-original-title="Update" data-toggle="tooltip"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
			    			</td>
			    			<td width="50">
				    			{{ Form::open(['method'=>'DELETE', 'url'=>'group/'.$group->id]) }}
				    			<a class="delete" data-original-title="Delete" data-toggle="tooltip" onclick="delGroup(this);"><i class="glyphicon glyphicon-trash"></i></a>
				    			{{ Form::close() }}
			    			</td>
			    		</tr>
			    	@endforeach
			    @else
			    	<tr>
			    		<td class="empty" colspan="3"><i>No result found.</i></td>
			    	</tr>
			    @endif
		    </tbody>
		</table>
		<div class="pull-right">
		{{ $groups->links() }}
		</div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	var delGroup = function(obj) {
		confirm('Are you sure want to delete this group? \nDeleting this group may destroy users with this group to!!');
		jQuery(obj).closest('form').submit();
	}
</script>
@endpush