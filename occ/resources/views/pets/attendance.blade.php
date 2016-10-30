@extends('admin.admin_toolbar')

@section('content')
<div class="container">
	<div class="page-header">
		<h2>Claimed Attendance Dates for {{$pet->name}}</h2> <br/>
	</div>
@include('info_pop_ups.info_flash')
@include('info_pop_ups.error_flash')
		<div class="row">
			<div class="col-md-2 col-md-offset-8"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#log-hour">Log Hours</button></div>
			
			@if(Auth::user()->isAdmin())
			<div class="col-md-2"><a class="btn btn-primary btn-sm" href="{{url('roster/list/none/none/0/1')}}" role="button">Back to Full Roster</a></div>
			@else
			<div class="col-md-2"><a class="btn btn-primary btn-sm" href="{{url('roster/list/' . 
			Auth::user()->instructor->id
			.'/none/0/1')}}" role="button">Back to Your Roster</a></div>
			@endif
		</div>
		<div class="spacer-sm"></div>
		<div class="row">
			<table class="table table-hover table-responsive table-striped"> 
				<tr>
					<th>Date Claimed to Have Attended</th>
					<th>User Added this Claim On</th>
					<th></th>

				</tr>
				<tbody>
					@foreach ($attendance as $att)
					<tr>
						<td>{{$att->pivot->attended_date}}</td>
						<td>{{$att->pivot->created_at}}</td>
						<td>{{ Form::open(['route' => ['roster.delete', $pet->id, $att->pivot->classes_id, $att->pivot->attended_date], 'method' => 'post', 'onsubmit' => "return show_alert();"]) }}
							<button  class="btn-danger" type="submit">Delete</button>
							{{ Form::close() }}</td>
						</tr>
						@endforeach


					</tbody>
				</table>
			</div>


			<!-- Modal Add logged hours-->
			<div class="modal fade" id="log-hour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h3 class="modal-title" id="myModalLabel">Hours for {{$class->details->title}}<small> {{ "  " . $class->begin_date . ' through ' . $class->end_date}}</h3>
						</div>
						<div class="modal-body">
							@if (count($attendance) == 0)
							<h4>No dates have been recorded for this class yet.</h4>
							@else
							<h4>Attended Dates on Record</h4>
							<ul>
								@foreach ($attendance as $att)
								<li>{{$att->pivot->attended_date}}</li>
								@endforeach
							</ul>
							@endif
							{!! Form::open(['url' => '/admin_log_hours/', 'class' => 'form-horizontal']) !!}
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


			<script>
				function show_alert() {
					return confirm("You are about to remove claimed attendance hours.  This will automatically update the User's Profile.  Do you still wish to proceed?");
				}
				$('div.alert').delay(7000).slideUp(500);
			</script>
		</div>
		@endsection