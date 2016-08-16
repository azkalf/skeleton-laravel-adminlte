<div class="col-md-6">
	<div class="form-group has-feedback{{ $errors->has('menu_text') ? ' has-error' : '' }}">
		{{ Form::label('menu_text', 'Menu Text') }} <span class="required">*</span>
		{{ Form::text('menu_text', null, ['class'=>'form-control', 'placeholder'=>'Menu Text']) }}
	    @if ($errors->has('menu_text'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('menu_text') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('menu_url') ? ' has-error' : '' }}">
		{{ Form::label('menu_url', 'Menu Url') }} <span class="required">*</span>
		{{ Form::text('menu_url', null, ['class'=>'form-control', 'placeholder'=>'Menu Url']) }}
	    @if ($errors->has('menu_url'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('menu_url') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('menu_parent') ? ' has-error' : '' }}">
		{{ Form::label('menu_parent', 'Menu Parent') }}
		{{ Form::select('menu_parent', ['default'=>'']+$menuList, null, ['class'=>'form-control']) }}
	    @if ($errors->has('menu_parent'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('menu_parent') }}</strong>
	        </span>
	    @endif
	</div>
</div>
<div class="col-md-6">
	<div class="form-group has-feedback{{ $errors->has('menu_icon') ? ' has-error' : '' }}">
		{{ Form::label('menu_icon', 'Menu Icon') }} <span class="required">*</span>
		{{ Form::button(null, ['class'=>'btn btn-default form-control', 'data-iconset'=>'fontawesome', 'data-icon'=>isset($menu->menu_icon) ? $menu->menu_icon : 'fa-circle', 'role'=>'iconpicker', 'name'=>'menu_icon']) }}
	    @if ($errors->has('menu_icon'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('menu_icon') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('menu_classname') ? ' has-error' : '' }}">
		{{ Form::label('menu_classname', 'Menu Classname') }}
		{{ Form::text('menu_classname', null, ['class'=>'form-control', 'placeholder'=>'Menu Classname']) }}
	    @if ($errors->has('menu_classname'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('menu_classname') }}</strong>
	        </span>
	    @endif
	</div>
	<div class="form-group has-feedback{{ $errors->has('menu_order') ? ' has-error' : '' }}">
		{{ Form::label('menu_order', 'Menu Order') }}
		{{ Form::text('menu_order', null, ['class'=>'form-control', 'placeholder'=>'Menu Order']) }}
	    @if ($errors->has('menu_order'))
	        <span class="help-block text-red">
	            <strong>{{ $errors->first('menu_order') }}</strong>
	        </span>
	    @endif
	</div>
</div>

@push('style')
<style type="text/css">
	.iconpicker .caret {
	    margin-left: 10px !important;
	}

	.iconpicker {
	    min-width: 60px;
	}

	.iconpicker input.search-control {
	    margin-bottom: 6px;
	    margin-top: 6px;
	}

	div.iconpicker.left .table-icons {
	    margin-right: auto;
	}

	div.iconpicker.center .table-icons {
	    margin-left: auto;
	    margin-right: auto;
	}

	div.iconpicker.right .table-icons {
	    margin-left: auto;
	}

	.table-icons .btn {
	    min-height: 30px;
	    min-width: 35px;
	    text-align: center;
	    padding: 0;
	    margin: 2px;
	}

	.table-icons td {    
	    min-width: 39px;
	}

	.popover {
	    max-width: inherit !important;
	}

	.iconpicker-popover {
	  z-index: 1050 !important;
	}

	.iconpicker-popover .search-control {
	    margin-bottom: 6px; 
	    margin-top: 6px;
	}
</style>
@endpush
@push('script')
<script type="text/javascript" src="{{ asset('/ext/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.3.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ext/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>
@endpush