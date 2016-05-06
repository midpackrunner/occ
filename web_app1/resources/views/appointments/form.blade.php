	
	
 <div class="form-group">
	{!! Form::label('appointment_name', 'Class Name') !!}
	<select id="appointment_name" name="appointment_name" class= "select-picker">
		@foreach($appointments as $app)
			<option value="{{ $app->id }}"> {{ $app->appointment_name }} </option>
		@endforeach
	</select>
</div>

<div class="form-group">
	{!! Form::label('app_date', 'Appointment Ajax Example ') !!}
	{!! Form::input('date','app_date', date('m-d-Y'), ['class' => 'form-control date_pick']) !!}
</div>



<div class="form-group">
	{!! Form::submit($submitButtonLabel, ['class' => 'btn btn-primary form-control']) !!}
</div>

		