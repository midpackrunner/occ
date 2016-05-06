@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
	<h1>Appointments</h1>

  @foreach ($appointments as $appointment)
	<article>
		<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ action('AppointmentController@show', [$appointment->id]) }}"> {{ $appointment->appointment_name }}</a>
		</div>
		<div class="panel-body"> 
		<p>{{ $appointment->appointment_date }}</p>
		<p>{{ $appointment->appointment_time }}</p>
		<p>{{ $appointment->doctor->last_name }} , {{ $appointment->doctor->first_name }} </p>
		</div>
		</div>
	</article>
	@endforeach

@endsection