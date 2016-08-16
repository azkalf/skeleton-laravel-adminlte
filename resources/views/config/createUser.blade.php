@extends('layouts.adminlte')
@section('title', 'User Configuration')
@section('content')
{{ Form::model($user, ['method'=>'POST', 'url'=>'/user']) }}
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Create User</h3>
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

@push('script')
<style type="text/css">
	img {
		max-height: 200px;
		max-width: 200px;
	}
</style>
<script type="text/javascript">
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#userPhoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#photo").change(function(){
        readURL(this);
    });
</script>
@endpush