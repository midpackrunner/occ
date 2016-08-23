@extends('layouts.app')


@section('content')
@foreach ($instructors as $instructor)




<?php 
$path_to_img = $instructor->bio->path_to_pic;
$path_to_img = str_replace('\\', '/', $path_to_img);

?>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="text-primary">{{ $instructor->first_name . " " . $instructor->last_name}}</h4>
			</div>
			<div class="panel-body">
				@if (isset($instructor->bio->path_to_pic) && ($instructor->bio->path_to_pic != ''))
				<div class="col-md-3 ">
					<img class="img-responsive img-rounded" src="{{ asset ($path_to_img) }}" alt="picture">
				</div>
				<div class="col-md-9">
					<p class="text-info">
						{!! nl2br($instructor->bio->bio) !!}
					</p>
				</div>	
				@else
					<div class="text-info">
						{!! nl2br($instructor->bio->bio) !!}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>


<div class="spacer-sm"></div>


@endforeach

@endsection