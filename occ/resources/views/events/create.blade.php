@extends('admin.admin_toolbar')

@section('content')
<h2>Create a new Event</h2>
<div class="row">
	<div class="col-md-12">
		{!! Form::open(['url' => 'events', 'class' => 'form-horizontal']) !!}
		@include('events.form', ['submitButtonLabel' => 'Create Event'])
		{!! Form::close() !!}
	</div>
</div>
@endsection