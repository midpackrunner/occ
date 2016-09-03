
@include('info_pop_ups.info_flash')
<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {!! Form::label('first_name', 'First Name', ['class' => 'control-label col-md-2']) !!}

    <div class="col-md-8">
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}

        @if ($errors->has('first_name'))
        <span class="help-block">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {!! Form::label('last_name', 'Last Name', ['class' => 'control-label col-md-2']) !!}

    <div class="col-md-8">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}

        @if ($errors->has('last_name'))
        <span class="help-block">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Email', ['class' => 'control-label col-md-2']) !!}
    <div class="col-md-4">
        @if (isset($instructor))
        {!! Form::select('email', $usr_emails, $instructor->user->id,['class' => 'form-control', 'id' => 'email-select']) !!}
        @else
         {!! Form::select('email', $usr_emails, null,['class' => 'form-control', 'id' => 'email-select']) !!}
        @endif
        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
    {!! Form::label('bio', 'Biography', ['class' => 'control-label col-md-2']) !!}

    <div class="col-md-8">
        {!! Form::textarea('bio', (isset($instructor)) ? $instructor->bio->bio : null, ['class' => 'form-control']) !!}

        @if ($errors->has('bio'))
        <span class="help-block">
            <strong>{{ $errors->first('bio') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('img_of_instructor') ? ' has-error' : '' }}">
{!! Form::label('img_of_instructor', 'Image Upload', ['class' => 'control-label col-md-2']) !!}
    <div class="col-md-6">
        {!! Form::file('img_of_instructor', null, ['class' => 'form-control']) !!}
        @if ($errors->has('img_of_instructor'))
        <span class="help-block">
            <strong>{{ $errors->first('img_of_instructor') }}</strong>
        </span>
        @endif
    </div>
    <div class="col-md-6"><h6>(Recommended Size: 230px X 230px)</h6></div>
</div>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        {!! Form::submit($submitButtonLabel, ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
