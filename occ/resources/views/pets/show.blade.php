@extends('layouts.app')

@section('title', 'Pet Profile')


@section('content')
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<h2 class='text-primary'>{{$pet->name}}'s History Details</h2>
		<h4 class='text-info'>Below are the current records we have for {{$pet->name}}.  If you feel any of these records are not accurate, please contact <a href="{{url('contact')}}">our director</a>.  Thank you.</h4>
	</div>
	<div class="col-md-1">
		<a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
	</div>
</div>

<div class="spacer-md"></div>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h3 class='text-primary'>{{$pet->name}}'s Class History</h3>
		@if(count($pet->classes) > 0)
		<table class="table table-striped table-primary table-hover table-responsive">
			<tr>
				<th> Class Taken </th>
				<th> Class Finished Date</th>
				<th> Hours Taken </th>
				<th> Successfully Completed Class</th>
			</tr>
			<tbody>
				@foreach($pet->classes as $class)
				<tr>
					<td> {{$class->details->title}}</td>
					<td> {{$class->end_date}}</td>
					<td> {{$class->pivot->logged_hours}}</td>
					<td> {{$class->pivot->is_completed ? 'Yes' : 'No'}} </td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<h4 class="text-danger">There are no class records currently for {{$pet->name}} </h4>
		@endif

		<h3 class='text-primary'>{{$pet->name}}'s Current Medical Record(s)</h3>
		@if(count($pet->med_records) > 0)
		<table class="table table-striped table-primary table-hover table-responsive">
		<tr>
			<th>Date file was uploaded</th>
			<th>Medical Record</th>
		</tr>
		<tbody>
		@foreach($pet->med_records as $med_rec)
		<tr>
			<td>{{$med_rec->created_at}}</td>
			<td><a class="btn btn-primary btn-sm" href="{{ url('/download_med_rec/' . $med_rec->id) }}">Download Medical Record</a></td>
		</tr>
		@endforeach
		</tbody>
		</table>	
		@else
		<h4 class="text-danger">We currently do not have medical records for {{$pet->name}} stored in our online system.  This is most likely due to you choosing not to upload your pet records when you created {{$pet->name}}'s profile. If you have physically dropped off your medical records with OCC then those records will not be shown here.  Contact our director if you have any questions or concerns.</h4>
		@endif

	</div>
</div>


@endsection