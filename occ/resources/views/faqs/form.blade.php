	

<div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
    {!! Form::label('question', 'Question', ['class' => 'control-label col-md-3']) !!}

    <div class="col-md-7">
        {!! Form::text('question', null, ['class' => 'form-control']) !!}

        @if ($errors->has('question'))
        <span class="help-block">
            <strong>{{ $errors->first('question') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
    {!! Form::label('answer', 'Answer', ['class' => 'control-label col-md-3']) !!}

    <div class="col-md-7">
        {!! Form::textarea('answer', null, ['class' => 'form-control']) !!}

        @if ($errors->has('answer'))
        <span class="help-block">
            <strong>{{ $errors->first('answer') }}</strong>
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