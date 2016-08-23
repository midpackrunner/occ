@extends('layouts.app')

@section('content')

@section('title', 'Class Schedule')
@include('classes.class_nav_bar')

@if(Auth::guest())
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
	<p class="text-danger"><strong>To sign up for a class, you must become a member.  If you are already a member, you must Log in before signing up for a class.</strong></p>
	</div>
</div>
@else
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
	@if (count(Auth::user()->pets) == 0)
	<p class="text-danger"><strong>To sign up for a class, you must register at least one dog.  Your dog can be registered on your <i>profile</i> page or by <a href=" {{ url('/profiles', Auth::user()->user_profile->id) }} ">clicking here</a></strong></p>
	@else
	<p class="text-info"><strong>Be sure to register your dog before signing up for a class.  Your dog can be registered on your <i>profile</i> page or by <a href=" {{ url('/profiles', Auth::user()->user_profile->id) }} ">clicking here</a>.</strong></p>
	@endif
	</div>
</div>
@endif


<div class="row">

	<div class="col-md-1"></div>
	<div class="col-md-10">
		<ul class="pagination pagination-lg pull-right">
			@for ($i = 1; $i <= $num_of_pages; $i++)
			<li class= <?php if($i == $curr_page) echo "active"; ?> ><a href="{{ $i }}"> {{$i}}</a></li>
			@endfor
		</ul>
		<table class="table table-striped table-hover table-responsive">
			<tr>
				<th>Session</th>
				<th>Title</th>
				<th>Entrance</th>
				<th>Instructor(s)</th>
				<th>Day of the Week</th>
				<th>Time</th>
				<th>Begins</th>
				<th>Ends</th>
				<th>Vacany</th>
				@if(!Auth::guest() && (count(Auth::user()->pets) != 0))
				<th></th>
				@endif
			</tr>
			@foreach ($classes as $class)
			@if ($class->vacant != 0)
			<tr>
				<td> {{ $class->session }}</td>
				<td> <a href="/class_details/{{ $class->details->id }}">{{ $class->details->title }}</a></td>
				<td> {{ $class->entrance }}</td>
				<td> 
					@foreach ($class->instructors as $instructor)
					{{ $instructor->first_name . ' ' . $instructor->last_name }} <br/>
					@endforeach
				</td>
				<td> {{ $class->day_of_week }}</td>
				<td> {{ $class->time }}</td>
				<td> {{ $class->begin_date }}</td>
				<td> {{ $class->end_date }}</td>
				<td> {{ $class->vacant }}</td>
				@if(!Auth::guest() && (count(Auth::user()->pets) != 0))
				<td><a class="btn btn-info btn-sm" href="{{ url('/class_sign_up/'. $class->id) }}" role="button">Sign Up!</a></td>
				@endif
			</tr>	
			@endif
			@endforeach
		</table>
	</div>
	<div class="col-md-1"></div>
</div>

@endsection