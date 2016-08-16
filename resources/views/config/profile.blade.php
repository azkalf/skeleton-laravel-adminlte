@extends('layouts.adminlte')
@section('title', 'Company Configuration')
@section('content')
{{ Form::model($user, ['method'=>'PATCH', 'url'=>'/user/'.$user->id, 'enctype'=>'multipart/form-data']) }}
	<div class="box box-success box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Your Profile</h3>
		</div>
		<div class="box-body">
			@include('common.status')
			<?php
		      $photo = !empty($user->photo) ? $user->photo : ($user->sex = 'm' ? 'ikhwan.png' : 'akhwat.png');
			?>
			{{ Html::link('/changePassword', 'Change Password', ['class'=>'btn btn-flat btn-success pull-right']) }}
			
			<div class="control-group">
				<div class="controls">
					<img id="userPhoto" src="{{ asset('/images/'.$photo) }}" alt="User Photo">
				</div>
			</div>
			<div class="form-group has-feedback{{ $errors->has('photo') ? ' has-error' : '' }}">
				{{ Form::label('photo', 'User Photo') }}
				{{ Form::file('photo', ['id'=>'photo']) }}
                @if ($errors->has('photo'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
				{{ Form::label('name', 'Username') }} <span class="required">*</span>
				{{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Username']) }}
                @if ($errors->has('name'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group has-feedback{{ $errors->has('fullname') ? ' has-error' : '' }}">
				{{ Form::label('fullname', 'Full Name') }} <span class="required">*</span>
				{{ Form::text('fullname', null, ['class'=>'form-control', 'placeholder'=>'Full Name']) }}
                @if ($errors->has('fullname'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('fullname') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
				{{ Form::label('email', 'Email') }} <span class="required">*</span>
				{{ Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) }}
                @if ($errors->has('email'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group has-feedback{{ $errors->has('sex') ? ' has-error' : '' }}">
				{{ Form::label('sex', 'Sex') }} <span class="required">*</span>
				{{ Form::select('sex', ['m'=>'Male', 'f'=>'Female'], null, ['class'=>'form-control']) }}
                @if ($errors->has('sex'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('sex') }}</strong>
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

@push('style')
<style type="text/css">
	img {
		max-height: 200px;
		max-width: 200px;
	}
</style>
@endpush

@push('script')
<script type="text/javascript">
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#companyLogo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#logo").change(function(){
        readURL(this);
    });
</script>
@endpush