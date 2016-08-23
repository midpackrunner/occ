@extends('layouts.app')
@section('title', 'Create a New Class')

@section('content')

<div class="row">
	<div class="col-md-5 col-md-offset-7">
		<a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
	</div>
</div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
		{!! Form::open(['url' => 'volunteer', 'class' => 'form-horizontal']) !!}
		
		<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
			{!! Form::label('description', 'Description', ['class' => 'control-label col-md-4']) !!}
			<div class="col-md-6">
				{!! Form::textarea('description', 'Please provide a brief explanation and the dates (if applicable) of the volunteer hours being claimed.', ['class' => 'form-control']) !!}
				@if ($errors->has('description'))
				<span class="help-block">
					<strong>{{ $errors->first('description') }}</strong>
				</span>
				@endif
			</div>
		</div>


		<div class="form-group{{ $errors->has('hours') ? ' has-error' : '' }}">
			{!! Form::label('hours', 'Total Hours: ', ['class' => 'control-label col-md-3 col-md-offset-5']) !!}
			<div class="col-md-2">
				{!! Form::input('number','hours', '0', ['class' => 'form-control']) !!}
				@if ($errors->has('hours'))
				<span class="help-block">
					<strong>{{ $errors->first('hours') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('accept') ? ' has-error' : '' }}">
			{!! Form::label('accept', 'By checking this box you are acknowledging the above description and hours claimed are accurate to the best of your recollection. ', ['class' => 'control-label col-md-5 col-md-offset-4']) !!}
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



		<div class="form-group">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				{!! Form::submit('Submit Hours for Review', ['class' => 'btn btn-primary form-control', 'id' => 'submit-button']) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#submit-button').prop("disabled", true);
	});
	

	$('#accept').click(function(){
		if($('#accept').prop('checked')) {
			$('#submit-button').prop("disabled", false);
		} else {
			$('#submit-button').prop("disabled", true);
		}
	});

</script>
@stop