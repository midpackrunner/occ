@extends('admin.admin_toolbar')

@section('title', 'Instructors')

@section('content')
<h3>Instructors</h3>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-hover table-responsive">
				<tr>
					<th>Instructor's ID</th>
					<th>Email</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Created At</th>
					<th>Last Updated</th>
					<th></th>

				</tr>
				@foreach ($instructors as $instructor)
				<tr>
					<td><center> {{ $instructor->id }}</center></td>
					<td>{{$instructor->user->email}}</td>
					<td> {{ $instructor->first_name }}</td>
					<td> {{ $instructor->last_name }}</a></td>
					<td> {{ $instructor->created_at }}</td>
					<td> {{ $instructor->bio->updated_at }}</td>
					<td>
						<a class="btn btn-warning btn-sm" href="{{ route('instructors.edit', $instructor->id) }}" role="button">Edit</a>
						<a class="btn btn-danger btn-sm jq-postback"  href="{{ route('instructors.destroy', $instructor->id) }}" data-method="delete" role="button">Delete</a>
					</td>
				</tr>	
				@endforeach
			</table>
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
				<a class="btn btn-primary btn-sm pull-right" href="{{ route('instructors.create')}}" role="button">Create a new Instructor Profile</a>
				</div>
			</div>
		</div>
	</div>

<script src="{{ asset('js/instructor.js') }}"></script>
</div>
@endsection