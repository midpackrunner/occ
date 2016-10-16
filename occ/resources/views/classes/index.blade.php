@extends('admin.admin_toolbar')

@section('title', 'Admin: Class Schedule')


@section('content')
@include('info_pop_ups.info_flash')
@include('admin.admin_class_nav_bar')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2" hidden><a class="btn btn-primary btn-sm" href="">Download List</a></div>
		<div class="col-md-2"><a class="btn btn-primary btn-sm" href=" {{route('classes.create')}}">Add New Class</a></div>
		<div class="col-md-3 col-md-offset-5">
			<a class="btn btn-info pull-right" href="{{ url('/upload_schedule') }}" role="button">Upload Schedule</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-6">
			<ul class="pagination pagination-lg pull-right">
				@for ($i = 1; $i <= $num_of_pages; $i++)
				<li class= <?php if($i == $curr_page) echo "active"; ?> ><a href="{{ $i }}"> {{$i}}</a></li>
				@endfor
			</ul>
		</div>
	</div>
	<div class="spacer-sm" style="margin-top:20px;"></div>
	<div class="row">
		<div class="col-md-12">
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
					<th>On Hold</th>
					<th>Is Active</th>
					<th></th>
				</tr>
				@foreach ($classes as $class)
				<tr>
					<td> {{ $class->session }}</td>
					<td> {{ $class->details->title }}</a></td>
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
					<td> {{ $class->on_hold }}</td>
					<td> {{ $class->is_open }}</td>
					<td>
						<a class="btn btn-warning btn-sm" href="{{ route('classes.edit', $class->id) }}" role="button">Edit</a>
					</td>
				</tr>	
				@endforeach
			</table>
		</div>
	</div>


</div>

@endsection