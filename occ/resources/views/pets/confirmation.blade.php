@extends('layouts.app')


@section('content')

<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<h2 class="text-success">{{ $pet_name}}'s profile has been registered!</h2>
		@if ($has_record)
		<h4 class="text-success">Thank you for registering.  You can now register {{$pet_name}} for any of the classes we offer.  Our staff will review {{$pet_name}}'s vaccination records you have submitted and will contact you if there is any issues.</h4>  
		<h4 class="text-success">Please submit future vaccination records to help us keep our records up to date.  You can simply update {{$pet_name}}'s vaccination records by going to Your Profile and clicking on the <strong> Edit </strong> Button.  Then, simply add the new vaccination record.  For any other questions related to our class room policies, please refer to the <a href=" {{ url('/pre_class_prep') }} ">Pre-Class Prep Page</a> </h4>

		@else
		<h4 class="text-success">Thank you for registering {{$pet_name}}.  You can now register {{$pet_name}} for any of the classes we offer.  Please be sure to provide proof of vaccination <strong>before or at</b> the first day of class.  For any other questions related to our class room policies, please refer to the <a href=" {{ url('/pre_class_prep') }} ">Pre-Class Prep Page</a></h4>

		@endif

		<a href=" {{ url('/profiles', Auth::user()->user_profile->id) }} ">Back to Your Profile Page</a>
	</div>
</div>

@endsection