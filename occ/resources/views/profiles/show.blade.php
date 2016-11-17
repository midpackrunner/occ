@extends('layouts.app')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-header">
	<h3>{{ $user_profile->first_name }} {{ $user_profile->last_name }}'s Profile</h3>
</div>
@include('info_pop_ups.info_flash')
@include('info_pop_ups.error_flash')
@if (Session::has('confirm_vol_hrs'))
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<div class="alert alert-success"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('confirm_vol_hrs')}}</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">Contact Information</div>
				<div class="panel-body">
					<dl class="dl-horizontal">
						<dt>Email: </dt>
						<dd>{{Auth::user()->email}}</dd>
					</dl>
					@if ($user_profile->street_address != null)
					<dl class="dl-horizontal">
						<dt>Phone Number(s):</dt>
						@foreach($user_profile->phone_numbers as $number)
						<dd>
							{!! $number->number !!} ({!! $number->type !!})
						</dd>
						<dd>

						</dd>
						@endforeach
					</dl>
					<dl class="dl-horizontal">
						<dt>Address:</dt>
						<dd>
							<address>
								{!! $user_profile->street_address !!} <br/>
								{!! $user_profile->city !!}, {!! $user_profile->state !!}, 
								{!! $user_profile->zip !!} 
							</address>
						</dl>
						@else
						<p class="text-danger text-center">You currently do not have any contact information.  Click <a href="#">here</a> to add your contact information</p>
						<br/>
						<p class="text-danger text-center">Contact information is needed to register for any of the classes offered by the Obedience Club of Chattanooga</p>
						@endif
					</dd>
					<div class="pull-right">	
						<button type="button" onclick="window.location='{{ url("profiles/" . $user_profile->id  . "/edit") }}'" class="btn-sm btn-default">Edit</button>
					</div>
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">Your Memebership Details: </div>
				<div class="panel-body">
					@if ($user_profile->membership == null)
					<p class="text-danger text-center">You are currently not a registered member.  You can find information on registering <a href="#">here</a></p>
					@else
					<dl class="dl-horizontal">
						<dt> Membership Type: </dt>
						<dd> {{ ucfirst($user_profile->membership->membership_type->name) }} </dd>
					</dl>
					<dl class="dl-horizontal">
						<dt> Membership Expires: </dt>
						<dd> {{ ucfirst($user_profile->membership->end_date) }} </dd>
					</dl>
					@endif
					<a class="btn btn-primary btn-sm" href="{{ url('memberships/' . $user_profile->membership->id . '/edit') }}" role="button">Renew Membership</a>
					@if ($user_profile->membership->membership_type->id != 4)
					<a class="btn btn-primary btn-sm pull-right" href="{{ url('membership_application/' . $user_profile->id) }}" role="button">Print Membership Application</a>
					@endif
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">Volunteer Hours </div>
				<div class="panel-body">
					@if ($user_profile->total_volunteer_hrs == null || $user_profile->total_volunteer_hrs == 0)
					<p class="text-danger text-center">You currently do not have any volunteer hours that can be used towards attending a class.</a></p>
					@else
					<dl class="dl-horizontal">
						<dt> Total Volunteer Hours </dt>
						<dd> {{ $user_profile->total_volunteer_hrs }} hours </dd>
					</dl>
					<p class="text-info text-center"> Volunteer hours can be used as a method of payment for our classes.  The hours shown above are hours that have <strong>not</strong> been used towards taking a class. </p>
					@if ($user_profile->total_volunteer_hrs < 6)
					<p class="text-danger text-center">A minimum of 6 hours is needed in order to be used towards <i>paying</i> for a class.</p>
					@endif
					@endif

					<a class="btn btn-primary btn-sm pull-right" href="{{ route('volunteer.create') }}" role="button">Claim new volunteer hours</a>
				</div>
			</div>
			<div class="spacer-md"></div>
			<h4 class="bg-primary"><center>Your Registered Dog(s)</center></h4>
			<a class="btn btn-primary btn-sm pull-right" href="{{ route('pets.create') }}" role="button">Add a new pet</a>
			<table class="table table-hover table-striped table-responsive">
				<thead>
					<tr>
						<th>Name</th>
						<th>Birthdate</th>
						<th>Breed</th>
						<th>Gender</th>
						<th>Spayed/Neutered?</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($user_profile->user->pets as $pet)
					<tr>
						<th>{{ $pet->name }}</th>
						<td>{{ $pet->birth_date }}</td>
						<td>{{ $pet->breed }}</td>
						<td>{{ $pet->gender }}</td>
						<td>
							@if ($pet->is_spayed_neutered == 1)
							Yes
							@else
							No
							@endif
						</td>
						<td>
							<a class="btn btn-warning btn-sm" href="{{ route('pets.edit', $pet->id) }}" role="button">Edit</a>
							<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{$pet->id}}">Delete</button>
							<a class="btn btn-info btn-sm" href="{{ route('pets.show', $pet->id) }}" role="button">View Details</a>
						</td>
					</tr>

					<div class="modal fade" id="delete-{{$pet->id}}">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title text-warning">Pet Profile Removal Confirmation</h4>
								</div>
								<div class="modal-body">
									<p class="test-warning">We are sorry to see you are removing {{$pet->name}}'s Profile.  Are you sure you wish to proceed?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<a class="btn btn-danger btn-sm jq-postback"  href="{{ route('pets.destroy', $pet->id) }}" data-method="delete" role="button">Delete</a>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->				
					@endforeach
				</tbody>
			</table>

			<div class="spacer-md"></div>

			<h4 class="bg-primary"><center>Currently Registered Classes</center></h4>
			@if (count(Auth::user()->pets) != 0)
			<?php $has_class = false; ?>
			@foreach(Auth::user()->pets as $pet)
			@if (count($pet->upcoming_classes) != 0)
			<?php $has_class = true; ?>
			@endif
			@endforeach
			@if ($has_class)
			<?php $i = 0 ?>
			<table class="table table-bordered table-striped table-condensed table-hover table-responsive">
				<thead>
					<tr>
						<th>Name</th>
						<th>Class</th>
						<th>Begin Date</th>
						<th>End Date</th>
						<th>Meeting Day and Time</th>
						<th>Current Hours Logged</th>
						<th>Log Hours</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->pets as $pet)
					@if (count($pet->upcoming_classes) != 0)
					@foreach($pet->upcoming_classes as $class)
					<tr>
						<td>{{$pet->name}}</td>
						<td><a class="center" href="{{ url('/class_details/'. $class->id) }}" role="button">{{$class->details->title}}</a></td>
						<td>{{$class->begin_date}}</td>
						<td>{{$class->end_date}}</td>
						<td>{{$class->day_of_week}} at {{$class->time}}</td>
						<td>{{$class->pivot->logged_hours}} out of 6</td>
						<td>
							@if ($class->pivot->logged_hours > 5 )	
							<p class="text-success">Class Completed!</p>
							@else
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#log-hour{{$i}}">Log Hours</button>
							@endif
						</td>
					</tr>	
					<?php $i++ ?>
					@endforeach
					@endif
					@endforeach
				</tbody> 
			</table>
			@else
			<p class="text-info">You do not have any currently enrolled classes.</p>
			@endif
			@else
			<p class="text-info">You do not have any currently enrolled classes.</p>
			@endif
		</div>
	</div>
	<div class="col-md-2"></div>
</div>


<!-- Button trigger modal -->



@if (count(Auth::user()->pets) != 0)
<?php $has_class = false; ?>
@foreach(Auth::user()->pets as $pet)
@if (count($pet->upcoming_classes) != 0)
<?php $has_class = true; ?>
@endif
@endforeach
@if ($has_class)
<?php $i = 0; ?>
@foreach(Auth::user()->pets as $pet)
@if (count($pet->upcoming_classes) != 0)
@foreach($pet->upcoming_classes as $class)
<!-- Modal -->
<div class="modal fade" id="log-hour{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel">Hours for {{$class->details->title}}<small> You have {{$class->pivot->logged_hours}} logged hours</h3>
			</div>
			<div class="modal-body">
				@if (count($pet->attendance()->where('classes_id', $class->id)->get()) == 0)
				<h4>No dates have been recorded for this class yet.</h4>
				@else
				<h4>Attended Dates on Record</h4>
				<ul>
					@foreach ($pet->attendance()->where('classes_id', $class->id)->get() as $attendance)
					<li>{{$attendance->pivot->attended_date}}</li>
					@endforeach
				</ul>
				@endif
				{!! Form::open(['url' => '/log_hours/', 'class' => 'form-horizontal']) !!}
				<div class="form-group{{ $errors->has('attended_date') ? ' has-error' : '' }}">
					{!! Form::label('attended_date', 'Date Attended', ['class' => 'control-label col-md-4']) !!}

					<div class="col-md-6">
						{!! Form::input('date','attended_date', date('Y-m-d'), ['class' => 'form-control']) !!}

						@if ($errors->has('attended_date'))
						<span class="help-block">
							<strong>{{ $errors->first('attended_date') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<input type="hidden" name="class_id" value="{{$class->id}}">
				<input type="hidden" name="pet_id" value="{{$pet->id}}">

				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
					<div class="col-md-4">
						{!! Form::submit('Update Hours', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
</div>
<?php $i++ ?>
@endforeach
@endif
@endforeach
@endif
@endif


<script src="{{ asset('js/user_profile.js') }}"></script>
<script type="text/javascript">
	$('div.alert').delay(7000).slideUp(500);
</script>
@endsection