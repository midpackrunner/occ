@extends('layouts.app')

@section('title', 'Edit Pet\'s Profile')

@section('content')
<h3>Edit: {!! $pet->name !!}'s Profile </h3>
    <div class="row">
    <div class="col-md-5 col-md-offset-7">
            <a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
        </div>
    </div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
	          {!! Form::model($pet, ['method' => 'PATCH','url' => 'pets/'. $pet->id, 'class' => 'form-horizontal', 'files'=>true]) !!}
		@include('pets.form', ['submitButtonLabel' => 'Update'])
		{!! Form::close() !!}
	</div>
</div>


@stop