@push('style')
<link href="{{ asset('/ext/treeview/jquery.treeview.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.sidebar-menu .treeview li {
    	background: none;
	    margin: 0px;
	    padding: 0px;
	}
</style>
<script src="{{ asset('/ext/treeview/jquery.treeview.js') }}" type="text/javascript"></script>
<script src="{{ asset('/ext/treeview/jquery.treeview.edit.js') }}" type="text/javascript"></script>
<script src="{{ asset('/ext/treeview/jquery.treeview.async.js') }}" type="text/javascript"></script>
@endpush
@push('script')
<script type="text/javascript">
	$(document).ready(function(){
		jQuery("#menu-list").treeview({'animated':'fast'});
	});
</script>
@endpush