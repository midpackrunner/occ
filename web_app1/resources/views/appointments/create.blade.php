@extends('layouts.app')

@section('title', 'Create an appointment')

@section('content')
	<h1>Write a new appointment</h1>

@include('errors.appointmentError')

	{!! Form::open(['url' => 'appointments']) !!}
		@include('appointments.form', ['submitButtonLabel' => 'Create appointment'])
	{!! Form::close() !!}

@endsection