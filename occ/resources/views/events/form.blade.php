<style type="text/css">
    .help-info {
    display: inline;
}
</style>	

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title of Event', ['class' => 'control-label col-md-3']) !!}

    <div class="col-md-7">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}

        @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('date_of_event') ? ' has-error' : '' }}">
    {!! Form::label('date_of_event', 'Date of Event', ['class' => 'control-label col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::input('date','date_of_event', null, ['class' => 'form-control']) !!}
        @if ($errors->has('date_of_event'))
        <span class="help-block">
            <strong>{{ $errors->first('date_of_event') }}</strong>
        </span>
        @endif
        <span class="help-info" style='display: inline;'>
            <p class="text-info">Events will automatically be removed after this date</p>
        </span>
    </div>
</div>


<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'control-label col-md-3']) !!}

    <div class="col-md-7">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

        @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>
</div>
>

<div class="form-group">
    <div class="col-md-5"></div>
    <div class="col-md-3">
        {!! Form::submit($submitButtonLabel, ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>