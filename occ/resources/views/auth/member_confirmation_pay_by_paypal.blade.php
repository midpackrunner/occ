@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
			<h1 class="display-3">Thank You For Applying To Our Club!</h1>
				<p class="lead">If you have signed up with a regular membership (Individual, Household, or Associate), then a New Member Application has been created for you.  Regular memberships are contingent on participating in 2 meetings (i.e. readings) with our club.  </p>
				<hr class="m-y-2">
				@include('auth.partial_bring_application')
				</p>
			</div>
		</div>
	</div>
</div>

@endsection