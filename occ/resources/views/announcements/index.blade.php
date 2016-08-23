@extends('admin.admin_toolbar')

@section('title', 'Edit a Class\' Details')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
	<div class="col-md-2 col-md-offset-10">
		<a class="btn btn-primary "  href="{{ route('announcements.create') }}"  role="button">Add a new announcement</a>
	</div>
</div>
<div class="spacer-md"></div>
<div class=""></div>
@foreach ($announcements as $announcement)
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>{{ $announcement->title }} <small>{{ "Publish On: " . $announcement->publish_on}}</small></h4>
	</div>
	<div class="panel-body">
		<div class="col-md-10">
			<blockquote> {{ $announcement->description }} </blockquote>
		</div>
		<div class="col-md-1">
			<a class="btn btn-warning pull-right" href="{{ route('announcements.edit', $announcement->id) }}" role="button">Edit</a>
		</div>
		<div class="col-md-1">

			<a class="btn btn-danger jq-postback"  href="{{ route('announcements.destroy', $announcement->id) }}" data-method="delete" role="button">Delete</a>
		</div>
	</div>
</div>
@endforeach


<script src="{{ asset('js/announcements.js') }}"></script>
@endsection
