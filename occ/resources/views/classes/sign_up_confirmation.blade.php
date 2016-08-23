@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-9 col-md-offset-1">
		<div class="jumbotron">
			<h1>Thank you for signing up for a class!</h1>
			<p>{{$pet->name}} is now registered for {{$class->details->title}}!</p>
			@if ($pay_method == 'paypal')
			<p>You have elected to use PayPal as the method of payment.</p>
			@elseif ($pay_method == 'check')
			<p>You have elected to pay by Check.  Your position will be held for this class.  Payments are expected <strong>prior to or the first day of class</strong>.  If you wish to mail your check, please mail it to: <a href="contact" role="button">Our Training Director</a> </p>
			@else
			<p>You have elected to use Volunteer Hours as a method to pay for classes.  We will review your currently registered volunteer hours and automatically deduct 6 hours.  You will be contacted if there is any issues.</p>
			@endif
			<p><a class="btn btn-primary btn-lg" href="/classes_schedule/1" role="button">Back to Class Schedule</a></p>
		</div>
	</div>
</div>

@endsection