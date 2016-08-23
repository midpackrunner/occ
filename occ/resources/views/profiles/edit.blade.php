@extends('layouts.app')


@section('content')
<h3>Edit: {!! $user_profile->first_name !!}'s Contact Info </h3>
@if (Session::has('flash_message'))
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<div class="alert alert-success"> 
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('flash_message')}}</div>
	</div>
</div>
@endif

<div class="row">
	<div class="col-md-5 col-md-offset-7">
		<a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
	</div>
</div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
		{!! Form::model($user_profile, ['method' => 'PATCH','url' => 'profiles/'. $user_profile->id, 'class' => 'form-horizontal']) !!}
		@include('profiles.form', ['submitButtonLabel' => 'Update Address Changes'])
		{!! Form::close() !!}
	</div>
</div>

<script type="text/javascript">
	$('div.alert').delay(1500).slideUp(500);
</script>

@endsection

