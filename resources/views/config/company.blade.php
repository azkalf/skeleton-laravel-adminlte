@extends('layouts.adminlte')
@section('title', 'Company Configuration')
@section('content')
{{ Form::model($company, ['method'=>'PATCH', 'url'=>'/company/'.$company->id, 'enctype'=>'multipart/form-data']) }}
	<div class="box box-success box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Your Company</h3>
		</div>
		<div class="box-body">
			@include('common.status')
			<?php
		      $logo = !empty($company->company_logo) ? $company->company_logo : 'no-image.jpg';
			?>
			<div class="control-group">
				<div class="controls">
					<img id="companyLogo" src="{{ asset('/images/'.$logo) }}" alt="Company Logo">
				</div>
			</div>
			<div class="form-group has-feedback{{ $errors->has('company_logo') ? ' has-error' : '' }}">
				{{ Form::label('company_logo', 'Company Logo') }}
				{{ Form::file('company_logo', ['id'=>'logo']) }}
                @if ($errors->has('company_logo'))
                    <span class="help-block text-red">
                        <strong>{{ $errors->first('company_logo') }}</strong>
                    </span>
                @endif
			</div>
			<div class="col-md-6">
				<div class="form-group has-feedback{{ $errors->has('company_name') ? ' has-error' : '' }}">
					{{ Form::label('company_name', 'Company Name') }} <span class="required">*</span>
					{{ Form::text('company_name', null, ['class'=>'form-control', 'placeholder'=>'Company Name']) }}
	                @if ($errors->has('company_name'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_name') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group has-feedback{{ $errors->has('company_shortname') ? ' has-error' : '' }}">
					{{ Form::label('company_shortname', 'Company Short Name') }}
					{{ Form::text('company_shortname', null, ['class'=>'form-control', 'placeholder'=>'Company Name']) }}
	                @if ($errors->has('company_shortname'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_shortname') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group has-feedback{{ $errors->has('company_email') ? ' has-error' : '' }}">
					{{ Form::label('company_email', 'Email Address') }} <span class="required">*</span>
					{{ Form::text('company_email', null, ['class'=>'form-control', 'placeholder'=>'Email Address']) }}
	                @if ($errors->has('company_email'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_email') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group has-feedback{{ $errors->has('company_homepage') ? ' has-error' : '' }}">
					{{ Form::label('company_homepage', 'Website') }}
					{{ Form::text('company_homepage', null, ['class'=>'form-control', 'placeholder'=>'Website']) }}
	                @if ($errors->has('company_homepage'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_homepage') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group has-feedback{{ $errors->has('company_pic') ? ' has-error' : '' }}">
					{{ Form::label('company_pic', 'Person in Charge') }}
					{{ Form::text('company_pic', null, ['class'=>'form-control', 'placeholder'=>'Person in Charge']) }}
	                @if ($errors->has('company_pic'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_pic') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group has-feedback{{ $errors->has('company_address') ? ' has-error' : '' }}">
					{{ Form::label('company_address', 'Address') }} <span class="required">*</span>
					{{ Form::text('company_address', null, ['class'=>'form-control', 'placeholder'=>'Address']) }}
	                @if ($errors->has('company_address'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_address') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group has-feedback{{ $errors->has('company_phone') ? ' has-error' : '' }}">
					{{ Form::label('company_phone', 'Phone') }}
					{{ Form::text('company_phone', null, ['class'=>'form-control', 'placeholder'=>'Phone']) }}
	                @if ($errors->has('company_phone'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_phone') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group has-feedback{{ $errors->has('company_fax') ? ' has-error' : '' }}">
					{{ Form::label('company_fax', 'Fax') }}
					{{ Form::text('company_fax', null, ['class'=>'form-control', 'placeholder'=>'Fax']) }}
	                @if ($errors->has('company_fax'))
	                    <span class="help-block text-red">
	                        <strong>{{ $errors->first('company_fax') }}</strong>
	                    </span>
	                @endif
				</div>
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