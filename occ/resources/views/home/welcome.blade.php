@extends('layouts.app')

@section('content')
<div class="container">
	<div class="page-header">
		<h1>Obedience Club of Chattanooga <small>Training You to Train Your Dog</small></h1>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading"><strong>Who We Are<strong></div>
				<div class="panel-body">
					The Obedience Club of Chattanooga is a non-profit organization offering affordable training classes to the public. Advanced classes are also offered for the serious performance dog competitor.	
				</div>
			</div>
		</div>
	</div>
	@include('carousel.carousel_partial')

	@include('home.announcement')
</div>



@endsection
