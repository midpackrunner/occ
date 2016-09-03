@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
			<h1 class="display-3 text-danger">Membership Renewal Cancelled</h1>
				<p class="lead text-danger">You have choosen to cancel your Pay Pal payment.  Your membership renewal fees are due by {{Auth::user()->user_profile->membership->end_date}}</p>
				<hr class="m-y-2">
								<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to My Profile Page</a>
			</div>
		</div>
	</div>
</div>

@endsection