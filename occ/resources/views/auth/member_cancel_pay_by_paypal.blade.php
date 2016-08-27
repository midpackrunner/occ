@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
			<h1 class="display-3">Thank You For Applying To Our Club!</h1>
				<p class="lead text-danger">A New Member Application has been created for you, however, you chose to pay through Pay Pal and have not completed the payment process.  If you wish to pay with Pay Pal, please click here.  If you wish to pay by check, please drop the check off with your next meeting with the Club.  Your membership is contingent on participating in 2 meetings (i.e. readings) with our club.</p>
				<hr class="m-y-2">
				@include('auth.partial_bring_application')
			</div>
		</div>
	</div>
</div>

@endsection