@extends('layouts.app')

@section('title', 'Update your phone number')

@section('content')

<div class="row">
	<div class="col-md-9 col-md-offset-1">
	          {!! Form::model($phone_number, ['method' => 'PATCH','url' => 'phone_numbers/'. $phone_number->id, 'class' => 'form-horizontal']) !!}
		@include('phone_numbers.form', ['submitButtonLabel' => 'Update'])
		{!! Form::close() !!}
	</div>
</div>


@stop
