@extends('admin.admin_toolbar')

@section('title', 'Create a New Class')

@section('content')

    <div class="row">
    <div class="col-md-5 col-md-offset-7">
            <a class="btn btn-primary btn-sm" href="{{ url('/classes_full_list/1') }}" role="button">Back to Class Schedule</a>
        </div>
    </div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
	          {!! Form::open(['url' => 'classes', 'class' => 'form-horizontal']) !!}
		@include('classes.form', ['submitButtonLabel' => 'Create'])
		{!! Form::close() !!}
	</div>
</div>


@stop