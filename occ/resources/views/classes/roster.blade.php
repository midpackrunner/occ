
@extends(Auth::user()->isAdmin() ? 'admin.admin_toolbar' : 'layouts.app')

@section('content')
<div class="page-header">
	<h1>Class Roster</h1>
</div>
@include('info_pop_ups.info_flash')
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
				@if(Request::is('roster/list/*/*/0/*'))
				Filter By Claimed Attendance
				@else
				{{ $num_of_clm_hrs }} or more claimed attendance
				@endif
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				@for ($i = 1; $i < 7; $i++)
				<li><a href="{{ url('/roster/list/'. $inst_filter . '/' . $session_filter . '/'. $i  . '/1') }}">
					{{ $i }} or more
				</a></li>
				@endfor
				<li><a href="{{ url('/roster/list/' . $inst_filter . '/'. $session_filter . '/' . '0' . '/1') }}">
					Clear Filter
				</a></li>
			</ul>
		</div>		
	</div>

	<div class="col-md-3">
	@if(Auth::user()->isAdmin())

		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
				@if(Request::is('roster/list/none/*'))
				Filter By Instructor
				@else
				{{ $curr_instrctr->first_name . ' ' . $curr_instrctr->last_name }}
				@endif
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				@foreach($instructors as $instructor)
				@if($session_filter != 'none')
				<li><a href="{{ url('/roster/list/'. $instructor->id . '/' . $session_filter . '/'. $num_of_clm_hrs  .'/1') }}">
					{{$instructor->first_name . ' ' .$instructor->last_name}}
				</a></li>
				@else
				<li><a href="{{ url('/roster/list/'. $instructor->id . '/none/' .$num_of_clm_hrs. '/1') }}">
					{{$instructor->first_name . ' ' .$instructor->last_name}}
				</a></li>
				@endif
				@endforeach
				<li><a href="{{ url('/roster/list/none/'. $session_filter . '/' .$num_of_clm_hrs. '/1') }}">
					Clear Filter
				</a></li>
			</ul>
		</div>
	@endif
	</div>
	<div class="col-md-3">
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
				@if(Request::is('roster/list/*/none/*'))
				Filter By Session
				@else
				{{ 'Session: ' . $session_filter }}
				@endif
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				@for($i = 1; $i <= $max_session; $i++)
				@if ($curr_instrctr != 'none')
				<li><a href="{{ url('/roster/list/'). '/' . $inst_filter . '/' . $i . '/' . $num_of_clm_hrs .'/1' }}" >
					{{ $i }}
				</a></li>
				@else
				<li><a href="{{ url('/roster/list/none/').  '/' . $i . '/' . $num_of_clm_hrs .'/1' }}" >
					{{ $i }}
				</a></li>
				@endif
				@endfor

				<li><a href="{{ url('/roster/list/' . $inst_filter . '/none/' . $num_of_clm_hrs . '/1') }}">
					Clear Filter
				</a></li>

			</ul>
		</div>
	</div>
</div>
<div class="spacer-sm"></div>
<div class="row">
	<div class="col-md-2"><a class="btn btn-primary btn-sm" href="{{ url('/download_roster/' . $inst_filter . '/' . $session_filter . '/' . $num_of_clm_hrs) }}">Download List</a></div>
	<div class="col-md-6 col-md-offset-6">
		<ul class="pagination pagination-lg pull-right">
			@for ($i = 1; $i <= $num_of_pages; $i++)
			<li class= <?php if($i == $curr_page) echo "active"; ?> ><a href="{{ $i }}"> {{$i}}</a></li>
			@endfor
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		@foreach ($classes as $class)
		<div class="panel panel-info">
			<div class="panel-heading" role="tab" id="detail-heading">
				<div class="row">
					<div class="col-md-4">
						<h4 class="panel-title">
							Session({{$class->session}}) {{ "  " . $class->details->title }}
						</h4>
					</div>
					<div class="col-md-4">
						<small>Instructor(s): 
							@foreach ($class->instructors as $instructor)
							{{$instructor->first_name . ' ' . $instructor->last_name . '  '}}
							@endforeach
						</small>
					</div>
					<div class="col-md-4">
						<small>
							Begin Date: {{$class->begin_date}}
						</small>
						<small>
							End Date: {{$class->end_date}}
						</small>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<small>
							When: {{$class->day_of_week . " at " . $class->time}}
						</small>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-responsive table-striped"> 
					<tr>
						<th>Dog's Name</th>
						<th>Breed</th>
						<th>Owner</th>
						<th>Email</th>
						<th>Phone #</th>
						<th>Claimed <br/> Attendance(hrs.)</th>
						@if(Auth::user()->isAdmin())<th>Verified Payment</th> @endif
					</tr>
					<tbody>
						@foreach ($class->pets as $pet)
						@if($pet->pivot->logged_hours >= $num_of_clm_hrs)
						<tr>
							<td>{{$pet->name}}</td>
							<td>{{$pet->breed}}</td>
							<td><a href="#" data-toggle="modal" data-target="#myModal{{$pet->user->user_profile->id}}">{{$pet->user->user_profile->first_name . " " . $pet->user->user_profile->last_name}}</a></td>
							<td>{{$pet->user->email}}</td>
							<td>
								@foreach($pet->user->user_profile->phone_numbers as $ph_num)
								{{$ph_num->number }} <br/>
								@endforeach
							</td>
							<td><a href="{{ url('roster_details/claimed_hours/' . $pet->id . '/' .$class->id) }}">{{$pet->pivot->logged_hours}} </a></td>
							@if(Auth::user()->isAdmin())
							<td>
								@if ($pet->pivot->verified_payment)
								Yes
								@else
								<a href="{{ url('roster/verified_payment/' . $class->id . '/' .$pet->id) }}">No</a>
								@endif
							</td>
							@endif
						</tr>
						@endif
						@endforeach	
					</tbody>
				</table>
			</div>
		</div>
		<?php $i++ ?>
		@endforeach
	</div>
</div>

@foreach ($classes as $class)	
@foreach ($class->pets as $pet)
<div id="myModal{{$pet->user->user_profile->id}}" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">{{$pet->user->user_profile->first_name . " " . $pet->user->user_profile->last_name . "'s Contact Info and Registered Dogs"}}</h4>
			</div>
			<div class="modal-body">
				<dl class="dl-horizontal">
					<dt>Phone Number(s):</dt>
					@foreach($pet->user->user_profile->phone_numbers as $number)
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
							{!! $pet->user->user_profile->street_address !!} <br/>
							{!! $pet->user->user_profile->city !!}, {!! $pet->user->user_profile->state !!}, 
							{!! $pet->user->user_profile->zip !!} 
						</address>
					<dd>
				</dl>
				@if (count($pet->user->user_profile->interests) != 0)
				<dl class="dl-horizontal">
					<dt>Interests:</dt>
					@foreach($pet->user->user_profile->interests as $interest)
					<dd>
					 {{$interest->name }}
					</dd>
					@endforeach
				</dl>
				@endif 
				<dl class="dl-horizontal">
					<dt>Registered Dogs:</dt>    <!-- This is WRONG -->
					@foreach($pet->user->user_profile->user->pets as $pet)
					<dd>
					 {{$pet->name   . ' Birthdate: ' . $pet->birth_date }}
					</dd>
					@endforeach
				</dl>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	@endforeach
	@endforeach
@endsection