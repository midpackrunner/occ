@extends('admin.admin_toolbar')


@section('content')
<h2>Edit FAQ </h2>
<div class="row">
	<div class="col-md-12">
		{!! Form::model($vol_hr, ['method' => 'PATCH','url' => 'volunteer/'. $vol_hr->id, 'class' => 'form-horizontal']) !!}
		@include('volunteer.form', ['submitButtonLabel' => 'Edit Volunteer Hour(s) Claim'])
		{!! Form::close() !!}
	</div>
</div>
@stop