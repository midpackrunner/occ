@extends('admin.admin_toolbar')

@section('content')
<div class="container">
	<div class="page-header">
		<h1>Admin Main Page</h1>
	</div>

	<div class="row">
	@include('admin.admin_notifications_partial')
	@include('admin.admin_class_overview_partial')
	</div>
	<div class="row">
	@include('admin.admin_task_bar_partial')
	</div>

@endsection
