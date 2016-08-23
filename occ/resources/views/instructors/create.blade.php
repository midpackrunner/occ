@extends('admin.admin_toolbar')

@section('title', 'Create an Instructor Profile')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-1">
		<h3>Create a New Instructor Profile</h3>
	</div>
	<div class="col-md-2">
		<a class="btn btn-danger pull-right" href="{{ url('/instructors') }}" role="button">Cancel</a>
	</div>
</div>
<div class="row">
	<div class="col-md-9 col-md-offset-1">

		{!! Form::open(['url' => 'instructors', 'class' => 'form-horizontal']) !!}
		@include('instructors.form', ['submitButtonLabel' => 'Create Profile'])
		{!! Form::close() !!}
	</div>
</div>
@endsection