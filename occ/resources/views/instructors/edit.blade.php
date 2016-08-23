@extends('admin.admin_toolbar')

@section('title', 'Edit an Article')

@section('content')
<h3>Edit: {!! $instructor->first_name .' '  . $instructor->last_name . '\'s Profile' !!} </h3>

<div class="row">
	<div class="col-md-9 col-md-offset-1"> 
		{!! Form::model($instructor, ['method' => 'PATCH','url' => 'instructors/'. $instructor->id, 'class' => 'form-horizontal', 'files'=>true]) !!}
		@include('instructors.form', ['submitButtonLabel' => 'Update Changes'])
		{!! Form::close() !!}
	</div>
</div>

@if (!empty($instructor->bio->path_to_pic))


@endif

@stop