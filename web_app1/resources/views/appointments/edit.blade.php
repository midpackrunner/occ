@extends('layouts.app')

@section('title', 'Edit an Appointment')

@section('content')
	<h1>Edit: {!! $appointment->title !!} </h1>

@include('errors.appointmentError')


	{!! Form::model($appointment, ['method' => 'PATCH','url' => 'appointments/'. $appointment->id]) !!}
		@include('appointments.form', ['submitButtonLabel' => 'Edit Article'])
	{!! Form::close() !!}

@stop