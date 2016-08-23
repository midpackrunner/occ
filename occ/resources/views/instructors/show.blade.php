@extends('admin.admin_toolbar')

@section('title', 'Instructor Profile Details')


@section('content')
<h3>Instructor Profile Details</h3>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<article>
			<div class="panel panel-primary">
				<div class="panel-heading">{{ $instructor->first_name .  '  ' . $instructor->last_name . '\'s Profile' }}</div>
				<div class="panel-body">
					<h6>Biography</h6>
					<p>{{ $instructor->bio->bio }}</p>
					@if (!empty($instructor->path_to_pic))

					<img scr="{{ $instructor->path_to_pic }}" alt="instructor image" class="img-rounded img-responsive"/>
					@endif
				</div>
			</div>
		</article>
	</div>
	<div class="col-md-1"></div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-8">
		<a class="btn btn-primary btn-sm pull-right" href="{{ url('/instructors')}}" role="button">Back to Instructors List</a>
	</div>
</div>
@endsection