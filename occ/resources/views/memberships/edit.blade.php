@extends('layouts.app')

@section('title', 'Membership Renewal')

@section('content')
<div class="row">
    <div class="col-md-5 col-md-offset-7">
        <a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
    </div>
</div>
<div class="spacer-sm"></div>

<div class="row">
<div class="col-md-7 col-md-offset-4">
<h3>{!! $membership->user_profile->first_name . ' ' . $membership->user_profile->last_name !!}'s Membership Renewal </h3>
</div>

<div class="spacer-md"></div>
    <div class="col-md-9 col-md-offset-1">
    {!! Form::model($membership, ['method' => 'PATCH','url' => 'memberships/'. $membership->id, 'class' => 'form-horizontal', 'files'=>true]) !!}

    <div class="form-group{{ $errors->has('membership_type_id') ? ' has-error' : '' }}">
        {!! Form::label('membership_type_id', 'Membership Type', ['class' => 'control-label col-md-4']) !!}
        <div class="col-md-6">
            {!! Form::select('membership_type_id', $membership_types, null, ['class' => 'form-control']) !!}
            @if ($errors->has('membership_type_id'))
            <span class="help-block">
                <strong>{{ $errors->first('membership_type_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4">Payment Method</label>
        <div class="col-md-6">
            @if(isset($membership))
            @if ($membership->payment_method == 'paypal')
            <label class="radio-inline"><input type="radio" name="payment_method" value="paypal" checked>Pay Pal</label>
            <label class="radio-inline"><input type="radio" name="payment_method" value="check">Check</label>
            @else
            <label class="radio-inline"><input type="radio" name="payment_method" value="paypal">Pay Pal</label>
            <label class="radio-inline"><input type="radio" name="payment_method" value="check" checked>Check</label>
            @endif
            @endif

        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4"></div>
        <div class="col-md-6">
            {!! Form::submit('Renew My Membership', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>
</div>

@endsection
