@extends('admin.admin_toolbar')

@section('content')
<div class="container">
	<div class="page-header">
		<div class="row">
			<div class="col-md-6">
				<h1>Class Roster</h1>

			</div>
			<div class="col-md-3">
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
						@if(Request::is('roster/none/*'))
						Filter By Instructor
						@else
						{{ $curr_instrctr->first_name . ' ' . $curr_instrctr->last_name }}
						@endif
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							@foreach($instructors as $instructor)
							@if($session_filter != 'none')
							<li><a href="{{ url('/roster/'. $instructor->id . '/' . $session_filter .'/1') }}">
								{{$instructor->first_name . ' ' .$instructor->last_name}}
							</a></li>
							@else
							<li><a href="{{ url('/roster/'. $instructor->id . '/none/1') }}">
								{{$instructor->first_name . ' ' .$instructor->last_name}}
							</a></li>
							@endif
							@endforeach
							<li><a href="{{ url('/roster/none/none/1') }}">
								Clear Filter
							</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
							@if(Request::is('roster/*/none/*'))
							Filter By Session
							@else
							{{ 'Session: ' . $session_filter }}
							@endif
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								@for($i = 1; $i <= $max_session; $i++)
								@if ($curr_instrctr != 'none')
								<li><a href="{{ url('/roster/'). '/' . $curr_instrctr->id . '/' . $i . '/1' }}" >
									{{ $i }}
								</a></li>
								@else
								<li><a href="{{ url('/roster/none/').  '/' . $i . '/1' }}" >
									{{ $i }}
								</a></li>
								@endif
								@endfor
								@if($curr_instrctr != 'none')
								<li><a href="{{ url('/roster/' . $curr_instrctr->id . '/none/1') }}">
									Clear Filter
								</a></li>
								@else
								<li><a href="{{ url('/roster/none/none/1') }}">
									Clear Filter
								</a></li>

								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2"><a class="btn btn-primary btn-sm" href="{{ url('/download_roster/' . $inst_filter . '/' . $session_filter) }}">Download List</a></div>
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
								</tr>
								<tbody>
									@foreach ($class->pets as $pet)
									<tr>
										<td>{{$pet->name}}</td>
										<td>{{$pet->breed}}</td>
										<td>{{$pet->user->user_profile->first_name . " " . $pet->user->user_profile->last_name}}</td>
										<td>{{$pet->user->email}}</td>
										<td>
											@foreach($pet->user->user_profile->phone_numbers as $ph_num)
												{{$ph_num->number }} <br/>
											@endforeach
										</td>
										<td><a href="{{ url('roster_details/claimed_hours/' . $pet->id . '/' .$class->id) }}">{{$pet->pivot->logged_hours}} </a></td>
									</tr>
									@endforeach	
								</tbody>
							</table>
						</div>
					</div>
					@endforeach
				</div>
			</div>

			@endsection