@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
			<h1 class="display-3">Thank You For Applying To Our Club!</h1>
				<p class="lead">A New Member Application has been created for you.  Your membership is contingent on us receiving your check via drop off or <i>snail mail</i>, and participating in 2 meetings (i.e. readings) with our club.  Our club meets the first Friday at 7 p.m. of each month.</p>
				<hr class="m-y-2">
				<p> Please be sure to print your application and bring it to the first meeting.  You can find the application on your <i>my profile</i> page.  You can get to your <i>my profile</i> page by clicking on your name in the main menu <strong>or</strong> by clicking on the button below </p>
				<p class="lead">
					<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Go to My Profile Page</a>
				</p>
			</div>
		</div>
	</div>
</div>

@endsection