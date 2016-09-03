@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="jumbotron">
				<h1 class="display-3 text-primary">Thank you for signing up!</h1>
				<p class="lead">{{$pet->name}} is now registered for {{$class->details->title}}!  Be sure to read over our <a href="{{ url('pre_class_prep')}}">pre-class preperation</a> page.</p>
				<hr class="m-y-2">
				<p class="lead">
					<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Go to My Profile Page</a>
				</p>
			</div>
		</div>
	</div>
</div>

@endsection