@extends('layouts.app')

@section('content')
@include('info_pop_ups.paymentInfoModal')


@if (empty($pet_arry))
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<h2 class="text-center text-danger">You do not have any Registered Pets that can take this Class!</h2>
		<h3 class="text-danger">Details</h3>
		<blockquote>
			<p class="lead text-danger">Our records show that all of your registered dogs have either already taken this class or are currently registered to take {{$class->details->title}}.</p>
			<p>You can find all of your registered dogs and the classes your dogs have taken on <a href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">your profile page</a>.
			  If you feel there is an error with our records, please contact our <a href="{{ url('/contact') }}">OCC Director</a>.  Thank you.</p>
		</blockquote>
	</div>
</div>
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<a href="/classes_schedule/1">Back to Class Schedule</a>
	</div>
</div>

@else
<!--Class Title -->
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<h2 class="text-center">Sign Up for {{ $class->details->title }}</h2>
		<h3 class="text-info">Class Details</h3>
		<blockquote>
			<dl class="dl-horizontal">
				<dt> Class: </dt>
				<dd> {{ $class->details->title }}</dd>
			</dl>

			@if (count($class->details->pre_reqs) == 1)

			<dl class="dl-horizontal">
				<dt>Prerequisite Class: </dt>
				<dd> {{ $class->details->pre_reqs[0]->title }} </dd>
			</dl>

			@elseif (count($class->details->pre_reqs) > 1)

			<dl class="dl-horizontal">
				<dt>Prerequisite Class:</dt>
				<dd>				
					@for ($i = 0; $i < count($class->details->pre_reqs); $i++)
					@if ($i + 1 == count($class->details->pre_reqs))
					{{ $class->details->pre_reqs[$i]->title   }} 
					@else
					{{ $class->details->pre_reqs[$i]->title . ' ' }} <b>or</b> {{ ' ' }}
					@endif
					@endfor
				</dd>
			</dl>

			@endif

			<dl class="dl-horizontal">
				<dt>Minimum Age:</dt>
				<dd> 
					@if ($class->details->minimum_age_requirement >= 12)
					{{ $class->details->minimum_age_requirement / 12  . ' years' }}

					@elseif ($class->details->minimum_age_requirement < 12)
					{{$class->details->minimum_age_requirement * 1 . ' months' }}
					@endif
				</dd>
			</dl>

			@if ($class->details->maximum_age_requirement < 90)
			<dl class="dl-horizontal">
				<dt>Maximum Age:</dt>
				<dd>
					@if ($class->details->maximum_age_requirement >= 12)
					{{ $class->details->maximum_age_requirement / 12  . ' years' }}

					@elseif ($class->details->maximum_age_requirement < 12)
					{{$class->details->maximum_age_requirement * 1 . ' months' }}
					@endif
				</dd>
			</dl>
			@endif

			<dl class="dl-horizontal">
				<dt>Instructor(s):</dt>
				<dd>
					@foreach ($class->instructors as $instructor)
					{{ $instructor->first_name . ' ' . $instructor->last_name . '  '}}
					@endforeach
				</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>Starts:</dt>
				<dd>{{ $class->begin_date }}</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>Ends:</dt>
				<dd>{{ $class->end_date }}</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>Meet At:</dt>
				<dd>On {{ $class->day_of_week }} at {{ $class->time }}</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>Entrance: </dt>
				<dd> {{$class->entrance}} </dd>
			</dl>
			
			<dl class="dl-horizontal">
				<dt>Cost: </dt>
				<dd> $ {{$class_cost}}</dd>
			</dl>

		</blockquote>	
	</div>
</div>
<!--Class Form -->
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		{!! Form::open(['url' => 'post_class_sign_up', 'class' => 'form-horizontal', 'id' => 'class-signup-form']) !!}

		<input type="hidden" name="class_id" value=" {{ $class->id }}">

		<div class="form-group{{ $errors->has('pet') ? ' has-error' : '' }}">
			{!! Form::label('pet', 'Dog to Sign Up', ['class' => 'control-label col-md-4']) !!}
			<div class="col-md-6">
				{!! Form::select('pet_id', $pet_arry, null,['class' => 'form-control']) !!}
				<small class="text-muted">
					Don't see your dog listed?  Please add your dog to your profile first.
				</small>
				@if ($errors->has('pet'))
				<span class="help-block">
					<strong>{{ $errors->first('pet') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="form-group {{ $errors->has('payment_method') ? 'has-error' : ''}}">
			<label class="col-md-4 control-label">Payment Method: 
				<span data-toggle="modal" data-target="#payment-method-info"class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
			</label>

			<div class="col-md-6">
				<label class="radio-inline"><input type="radio" name="payment_method" value="check" checked>Check</label>
				<label class="radio-inline"><input type="radio" name="payment_method" value="paypal" >Credit Card or Pay Pal</label>
				@if($user_profile->total_volunteer_hrs >= 15)
				<label class="radio-inline"><input type="radio" name="payment_method" value="volhours" >Use My Volunteer Hours</label>
				@endif
				@if ($errors->has('payment_method'))
				<span class="help-block">
					<strong>{{ $errors->first('payment_method') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('accept') ? ' has-error' : '' }}">
		
			<label class="control-label col-md-8 col-md-offset-1">By checking this box you are acknowledging that (a) you are 18 or older, and (b) you agree to our class waiver.
				<a data-toggle="modal" href="#class-waiver">What's this?</a>
			</label>
			<div class="col-md-1">
			<div class="checkbox pull-right">
  				<input type="checkbox" value="accepted" name="accept" id="accept" style="width: 20px; height: 20px;">
			</div>
				@if ($errors->has('accept'))
				<span class="help-block">
					<strong>{{ $errors->first('accept') }}</strong>
				</span>
				@endif
			</div>
		</div>
		@include('info_pop_ups.classwaiver')
		<div class="form-group">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				{!! Form::submit("Sign Up", ['class' => 'btn btn-primary form-control', 'id' => 'submit-button']) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endif

<input type="hidden" id="refresh" value="no">
<script type="text/javascript">
$(document).ready(function(e) {
    var $input = $('#refresh');

    $input.val() == 'yes' ? location.reload(true) : $input.val('yes');

	$('#submit-button').prop("disabled", true);
	$('#accept').click(function(){
		if($('#accept').prop('checked')) {
			$('#submit-button').prop("disabled", false);
		} else {
			$('#submit-button').prop("disabled", true);
		}
	});
});
</script>
@endsection