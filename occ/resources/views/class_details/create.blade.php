@extends('admin.admin_toolbar')

@section('title', 'Create a New Class')

@section('content')

    <div class="row">
    <div class="col-md-5 col-md-offset-7">
            <a class="btn btn-primary btn-sm" href="{{ url('/class_details') }}" role="button">Back to Classes</a>
        </div>
    </div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
	          {!! Form::open(['url' => 'class_details', 'class' => 'form-horizontal']) !!}
		@include('class_details.form', ['submitButtonLabel' => 'Create'])
		{!! Form::close() !!}
	</div>
</div>


@stop