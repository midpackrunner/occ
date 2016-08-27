@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
			<h1 class="display-3">Thank You For Applying To Our Club!</h1>
				<p class="lead">A New Member Application has been created for you.  Your membership is contingent on us receiving your check via drop off or <i>snail mail</i>, and participating in 2 meetings (i.e. readings) with our club.</p>
				<hr class="m-y-2">
				@include('auth.partial_bring_application')
				</p>
			</div>
		</div>
	</div>
</div>

@endsection