@if (Session::has('success'))
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Success!</h4>
	{{ Session::get('success') }}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-warning"></i> Ooops!</h4>
	{{ Session::get('error') }}
</div>
@endif