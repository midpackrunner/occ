@extends('admin.admin_toolbar')

@section('title', 'Edit a Class\' Details')

@section('content')

    <div class="row">
    <div class="col-md-5 col-md-offset-7">
            <a class="btn btn-primary btn-sm" href="{{ url('/class_details') }}" role="button">Back to Classes</a>
        </div>
    </div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
	          {!! Form::model($classes_details, ['method' => 'PATCH','url' => 'class_details/'. $classes_details->id, 'class' => 'form-horizontal']) !!}
		@include('class_details.form', ['submitButtonLabel' => 'Update'])
		{!! Form::close() !!}
	</div>
</div>


@stop