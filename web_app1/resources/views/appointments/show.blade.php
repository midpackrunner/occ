@extends('layouts.app')

@section('title', 'Appointment Details')


@section('content')
	<h1>Appointment Details</h1>

	<article>
		<div class="panel panel-primary">
		<div class="panel-heading">{{ $appointment->appointment_name }}</div>
		<div class="panel-body"> 
		{!! $appointment->appointment_date !!}
		{!! $appointment->appointment_time !!}
		</div>
		</div>
	</article>

@endsection