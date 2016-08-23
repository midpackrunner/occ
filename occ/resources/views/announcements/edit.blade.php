@extends('admin.admin_toolbar')


@section('content')
<h2>Edit Announcement </h2>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
		{!! Form::model($announcement, ['method' => 'PATCH','url' => 'announcements/'. $announcement->id, 'class' => 'form-horizontal']) !!}
		@include('announcements.form', ['submitButtonLabel' => 'Edit Announcement'])
		{!! Form::close() !!}
	</div>
</div>
@stop