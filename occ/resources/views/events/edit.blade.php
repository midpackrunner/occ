@extends('admin.admin_toolbar')


@section('content')
<h2>Edit Event </h2>
<div class="row">
	<div class="col-md-12">
		{!! Form::model($event, ['method' => 'PATCH','url' => 'events/'. $event->id, 'class' => 'form-horizontal']) !!}
		@include('events.form', ['submitButtonLabel' => 'Edit Event'])
		{!! Form::close() !!}
	</div>
</div>
@stop