@extends('admin.admin_toolbar')

@section('title', 'Admin: Class Schedule')


@section('content')
@include('info_pop_ups.info_flash')
<div class="container-fluid">
	<h3>Medical Record Verification for {{$medical_record->pet->name}}</h3>
	<div class="row">
		<div class="col-md-5 col-md-offset-6">
		<a class="btn btn-primary btn-sm" href="{{ url('/medical_records/1')}}" role="button">Back to Medical Records Listing</a>
		</div>
	</div>
	<div class="spacer-sm"></div>
	@if($medical_record->record_is_hardcopy == 1) <?php $hc_default = '1' ?> @else <?php $hc_default = '0' ?> @endif
	<div class="row">
		<div class="col-md-9 col-md-offset-1">
			{!! Form::model($medical_record, ['method' => 'PATCH','url' => 'medical_records/'. $medical_record->id, 'class' => 'form-horizontal', 'files'=>true]) !!}
			@include('admin.medical.form', ['submitButtonLabel' => 'Update', 
											'hardcopy_default' => $hc_default])
			{!! Form::close() !!}
		</div>
	</div>

	@endsection