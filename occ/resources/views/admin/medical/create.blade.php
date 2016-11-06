@extends('admin.admin_toolbar')

@section('title', 'Admin: Class Schedule')


@section('content')
@include('info_pop_ups.info_flash')
<div class="container-fluid">
	<h3>New Medical Record Verification </h3>
	<div class="row">
		<div class="col-md-5 col-md-offset-6">
				{!! link_to(URL::previous(), 'Back to Medical Records Listing', ['class' => 'btn btn-primary btn-sm']) !!}
		</div>
	</div>
	<div class="spacer-sm"></div>

	<div class="row">
		<div class="col-md-9 col-md-offset-1">
			{!! Form::open(['method' => 'POST','url' => 'medical_records/store', 'class' => 'form-horizontal', 'files'=>true]) !!}
            <div class="form-group{{ $errors->has('pet') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Dog</label>

              <div class="col-md-3">
                <select class="form-control"  name="pet" required="required">
                  @foreach($pets as $pet)
                  <option value="{{ $pet->id }}" @if (old('pet') == $pet->id) selected="selected" @endif>{{ $pet->name }}</option>
                  @endforeach 
                </select>
                

                @if ($errors->has('state'))
                <span class="help-block">
                  <strong>{{ $errors->first('state') }}</strong>
                </span>
                @endif
              </div>
            </div>
			@include('admin.medical.form', ['submitButtonLabel' => 'Create', 'hardcopy_default' => '1'])
			{!! Form::close() !!}
		</div>
	</div>

	@endsection