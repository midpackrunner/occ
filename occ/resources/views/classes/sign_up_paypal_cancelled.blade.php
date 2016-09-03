@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
				<h1 class="display-3 text-danger">Class Signup has been cancelled!</h1>
				<p class="lead text-danger">We are sorry you have decided to cancel your class registration.  If you feel you have reached this page in error, please contact our Director.  Thank you.</p>
				<hr class="m-y-2">
				<p class="lead">
					<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Go to My Profile Page</a>
				</p>
			</div>
		</div>
	</div>
</div>

@endsection