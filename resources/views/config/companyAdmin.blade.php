@extends('layouts.adminlte')
@section('title', 'Company Configuration')
@section('content')
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Manage Company</h3>
	</div>
	<div class="box-body">
		@include('common.status')
		<table class="table table-bordered table-striped" id="companies-table">
		    <thead>
		        <tr>
		            <th width="60px"></th>
		            <th>Company Name</th>
		            <th>Short Name</th>
		            <th>Address</th>
		            <th>Phone</th>
		            <th>Fax</th>
		            <th>Email</th>
		            <th>Homepage</th>
		        </tr>
		    </thead>
		    <tbody>
		    	@if (count($companies) > 0)
			    	@foreach($companies as $company)
			    		<?php $logo = empty($company->logo) ? 'no-image.jpg' : $company->logo; ?>
			    		<tr>
			    			<td>{{ Html::image(url('/images/'.$logo), $company->name.' logo') }}</td>
			    			<td>{{ $company->company_name }}</td>
			    			<td>{{ $company->company_shortname }}</td>
			    			<td>{{ $company->company_address }}</td>
			    			<td>{{ $company->company_phone }}</td>
			    			<td>{{ $company->company_fax }}</td>
			    			<td>{{ $company->company_email }}</td>
			    			<td>{{ $company->company_homepage }}</td>
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
		{{ $companies->links() }}
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