@extends('admin.admin_toolbar')

@section('content')
<h2>Create an Announcement</h2>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{!! Form::open(['url' => 'announcements', 'class' => 'form-horizontal']) !!}
		@include('announcements.form', ['submitButtonLabel' => 'Create Announcement'])
		{!! Form::close() !!}
	</div>
</div>
@endsection