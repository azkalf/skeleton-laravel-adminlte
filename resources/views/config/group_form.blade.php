<div class="row">
	<div class="col-md-6">
		<p><strong>Have Access Menu :</strong></p>
		<div style="max-height:400px;overflow:auto;border:solid 1px gray;padding:10px;">
			{!! $menuTree !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group has-feedback{{ $errors->has('group_name') ? ' has-error' : '' }}">
			{{ Form::label('group_name', 'Group Name') }} <span class="required">*</span>
			{{ Form::text('group_name', null, ['class'=>'form-control', 'placeholder'=>'Group Name']) }}
            @if ($errors->has('group_name'))
                <span class="help-block text-red">
                    <strong>{{ $errors->first('group_name') }}</strong>
                </span>
            @endif
		</div>
		<br><br>
    	{{ Form::submit('Save', ['class'=>'btn btn-primary btn-flat pull-right']) }}
	</div>
</div>