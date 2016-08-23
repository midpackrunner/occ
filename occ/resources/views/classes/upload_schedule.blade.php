@extends('admin.admin_toolbar')

@section('title', 'Admin: Class Schedule')


@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h3>Schedule Upload</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10"> 
		{!! Form::open(['url' => 'upload_schedule', 'class' => 'form-horizontal', 'files'=>true]) !!}
		<div class="form-group{{ $errors->has('class_schedule_file') ? ' has-error' : '' }}">
			{!! Form::label('class_schedule_file', 'Class Schedule File Upload', ['class' => 'control-label col-md-4']) !!}
			<div class="col-md-6">
				{!! Form::file('class_schedule_file', null, ['class' => 'form-control']) !!}
				@if ($errors->has('class_schedule_file'))
				<span class="help-block">
					<strong>{{ $errors->first('class_schedule_file') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			{!! Form::submit('Upload File', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-1"></div>

</div>

<div class="row">
	<div class="col-md-6 col-md-offset-1">
		@if (isset($num_of_records))
			<h3>Upload Results</h3>
			<p class="bg-success"> {{ $num_of_records }} Record(s) added</p>
		@endif
		@if (isset($duplicate_results) && (sizeof($duplicate_results) != 0))
			<h4 class="text-danger">Some records show as already existing (i.e. duplicates)</h4>

			@foreach ($duplicate_results as $result)
				<p class="bg-danger"> {{ $result }}</p>
			@endforeach
		@endif
	</div>
</div>

@endsection