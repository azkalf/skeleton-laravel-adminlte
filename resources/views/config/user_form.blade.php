<div class="control-group">
	<div class="controls">
		<img id="userPhoto" src="" alt="">
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

<div class="col-md-6">
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
		{{ Form::select('sex', ['m'=>'Male', 'f'=>'Female'], 'm', ['class'=>'form-control']) }}
	    @if ($errors->has('sex'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('sex') }}</strong>
	        </span>
	    @endif
	</div>
</div>
<div class="col-md-6">
	<div class="form-group has-feedback{{ $errors->has('group_id') ? ' has-error' : '' }}">
		{{ Form::label('group_id', 'Group') }} <span class="required">*</span>
		{{ Form::select('group_id', App\Group::groupList(), 'm', ['class'=>'form-control']) }}
	    @if ($errors->has('group_id'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('group_id') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('company_id') ? ' has-error' : '' }}">
		{{ Form::label('company_id', 'Company') }} <span class="required">*</span>
		{{ Form::select('company_id', App\Company::companyList(), 'm', ['class'=>'form-control']) }}
	    @if ($errors->has('company_id'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('company_id') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
		{{ Form::label('password', 'Password') }} <span class="required">*</span>
		{{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
	    @if ($errors->has('password'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('password') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
		{{ Form::label('password_confirmation', 'Password Confirmation') }} <span class="required">*</span>
		{{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Password Confirmation']) }}
	    @if ($errors->has('password_confirmation'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('password_confirmation') }}</strong>
	        </span>
	    @endif
	</div>
</div>