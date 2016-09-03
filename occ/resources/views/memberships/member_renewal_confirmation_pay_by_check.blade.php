@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
				<h1 class="display-3">Thank You For Renewing Your Membership !</h1>
				<p class="lead">You have elected to pay by check.  Upon receiving your payment, we will update your membership expiration date.  Please allow up to one week for your online records to be updated.</p>
				<hr class="m-y-2">
				<p class="text-info">Membership selected: {{$membership->membership_type->name}}</p>
				<p class="text-info">Expected Payment of  ${{$membership->membership_type->cost}}</p>

				<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Go to My Profile Page</a>
			</p>
		</div>
	</div>
</div>
</div>

@endsection