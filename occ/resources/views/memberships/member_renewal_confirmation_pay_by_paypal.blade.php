@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
				<h1 class="display-3">Thank You For Renewing Your Membership !</h1>
				<p class="lead">Your Membership has been extended.</p>
				<hr class="m-y-2">
				<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Go to My Profile Page</a>
			</p>
		</div>
	</div>
</div>
</div>

@endsection