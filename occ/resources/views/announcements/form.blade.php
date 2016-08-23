	

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'control-label col-md-4']) !!}

    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}

        @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'control-label col-md-4']) !!}

    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

        @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('publish_on') ? ' has-error' : '' }}">
    {!! Form::label('publish_on', 'Publish Date ', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
    {!! Form::input('date','publish_on', null, ['class' => 'form-control']) !!}
        @if ($errors->has('publish_on'))
        <span class="help-block">
            <strong>{{ $errors->first('publish_on') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('remove_on') ? ' has-error' : '' }}">
    {!! Form::label('remove_on', 'Remove Date ', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::input('date','remove_on', null, ['class' => 'form-control']) !!}
        @if ($errors->has('remove_on'))
        <span class="help-block">
            <strong>{{ $errors->first('remove_on') }}</strong>
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