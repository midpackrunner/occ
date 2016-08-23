@extends('layouts.app')

@section('title', 'New Phone Number')

@section('content')
<h3>Add a new Phone Number</h3>
<div class="row">
	<div class="col-md-5 col-md-offset-7">
		<a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
	</div>
</div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
{!! Form::open(['url' => 'phone_numbers', 'class' => 'form-horizontal']) !!}
<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
    {!! Form::label('phone_number', 'Primary Phone Number', ['class' => 'control-label col-md-4']) !!}

    <div class="col-md-6">
        {!! Form::text('phone_number', null, ['class' => 'form-control', 'id' => 'primary-phone-number']) !!}

        @if ($errors->has('phone_number'))
        <span class="help-block">
            <strong>{{ $errors->first('phone_number') }}</strong>
        </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('phone_type') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Phone Number Type</label>

    <div class="col-md-2">
        <select class="form-control selectpicker" name="phone_type">
            <option value="mobile" selected>Mobile</option>
            <option value="home">Home</option>
            <option value="work">Work</option>
        </select>

        @if ($errors->has('phone_type'))
        <span class="help-block">
            <strong>{{ $errors->first('phone_type') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        {!! Form::submit('Add Phone Number', ['class' => 'btn btn-primary form-control']) !!}
    </div>

</div>
{!! Form::close() !!}
</div>
</div>

<script src="{{ asset('js/phone.js') }}"></script>
@endsection