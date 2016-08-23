<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
    {!! Form::label('phone_number', 'Primary Phone Number', ['class' => 'control-label col-md-4']) !!}

    <div class="col-md-6">
        {!! Form::text('phone_number', $phone_number->number, ['class' => 'form-control', 'id' => 'primary-phone-number']) !!}

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
            @if ($phone_number->type == 'mobile')
            <option value="mobile" selected>Mobile</option>
            <option value="home">Home</option>
            <option value="work">Work</option>
            @elseif ($phone_number->type == 'home')
            <option value="mobile">Mobile</option>
            <option value="home" selected>Home</option>
            <option value="work">Work</option>
            @else
            <option value="mobile">Mobile</option>
            <option value="home">Home</option>
            <option value="work" selected>Work</option>
            @endif
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
        {!! Form::submit($submitButtonLabel, ['class' => 'btn btn-primary form-control']) !!}
    </div>

</div>