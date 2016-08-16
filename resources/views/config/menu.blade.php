@extends('layouts.adminlte')
@section('title', 'Menu Configuration')
@section('content')
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Manage Menu</h3>
	</div>
	<div class="box-body">
		@include('common.status')
		<div class="row">
			<div class="col-md-6">
				<div style="height:380px;overflow:auto;border:solid 1px gray;padding:10px;" id="menus">
					{!! $menuTree !!}
				</div>
			</div>
			<div class="col-md-6">
				{{ Html::link('/menu/create', 'Create Menu', ['class'=>'btn btn-flat btn-primary pull-right']) }}
				<br><br><br>
				<table class="table table-bordered table-striped" id="menu-table">
				    <thead>
				        <tr>
				            <th>Title</th>
				            <th>Detail<span>{{ Html::image(url('images/ajax-loader.gif'), null, ['style'=>'display:none;', 'class'=>'loader pull-right']) }}</span></th>
				        </tr>
				    </thead>
				    <tbody>
				    	<tr>
				    		<td class="empty" colspan="2"><i>No result found.</i></td>
				    	</tr>
				    </tbody>
				</table>
			</div>
		</div>
    </div>
</div>
@endsection

@push('script')
<style type="text/css">
	a.active {
		color: red;
	}
</style>
<script type="text/javascript">
	var changeGrid = function(obj) {
		$('#menu-list').find('a').removeClass('active');
		$('.loader').show();
		$(obj).addClass('active');
		id = $(obj).data('id');
		if (id) {
			$.ajax({
				type: "POST",
		        data: "id="+id+"&_token={{ csrf_token() }}",
				url: "{{ url('/menuAjax') }}",
				success: function(response) {
					$('.loader').hide();
					$('#menu-table tbody').html(response);
				}
			});
		} else {
			$('.loader').hide();
			$('#menu-table tbody').html('<tr><td class="empty" colspan="2"><i>No result found.</i></td></tr>');
		}
	}

	var delMenu = function(obj) {
		confirm('Are you sure want to delete this menu?');
		jQuery(obj).closest('form').submit();
	}
/*
	var delMenu = function(obj) {
		confirm('Are you sure want to delete this menu?');
		id = $(obj).data('id');
		$('.loader').show();
		$.ajax({
			type: "POST",
	        data: "id="+id+"&_token={{ csrf_token() }}",
			url: "{{ url('/menuDel') }}",
			success: function(response) {
				$('.loader').hide();
				alert(response);
				changeGrid();
				$(obj).remove();
			}
		});
	}*/
</script>
@endpush

@include('common.treeview')