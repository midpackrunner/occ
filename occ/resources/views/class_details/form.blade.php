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

<div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
    {!! Form::label('cost', 'Cost', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('cost', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cost'))
        <span class="help-block">
            <strong>{{ $errors->first('cost') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('minimum_age_requirement') ? ' has-error' : '' }}">
    {!! Form::label('minimum_age_requirement', 'Minimum Age Req.', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('minimum_age_requirement', null, ['class' => 'form-control']) !!}
        @if ($errors->has('minimum_age_requirement'))
        <span class="help-block">
            <strong>{{ $errors->first('minimum_age_requirement') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('maximum_age_requirement') ? ' has-error' : '' }}">
    {!! Form::label('maximum_age_requirement', 'Maximum Age Req.', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('maximum_age_requirement', null, ['class' => 'form-control', 'data-toggle' => 'popover', 'data-content' => 'Supply 99.99 if there is not a maximum age restriction.']) !!}
        @if ($errors->has('maximum_age_requirement'))
        <span class="help-block">
            <strong>{{ $errors->first('maximum_age_requirement') }}</strong>
        </span>
        @endif
    </div>
</div>


<div class="form-group">
    <label class="control-label col-md-4">Activated ?</label>
    <div class="col-md-6">
        @if(isset($classes_details))
        @if ($classes_details->is_active == 1)
            <label class="radio-inline"><input type="radio" name="is_active" value="1" checked>Yes</label>
            <label class="radio-inline"><input type="radio" name="is_active" value="0">No</label>
        @endif
        @if ($classes_details->is_active == 0)
            <label class="radio-inline"><input type="radio" name="is_active" value="1">Yes</label>
            <label class="radio-inline"><input type="radio" name="is_active" value="0" checked>No</label>
        @endif
        @else
        <label class="radio-inline"><input type="radio" name="is_active" value="1">Yes</label>
        <label class="radio-inline"><input type="radio" name="is_active" value="0" checked>No</label>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        {!! Form::submit($submitButtonLabel, ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>

<script type="text/javascript">
$('[data-toggle="popover"]').focus(function() { 
   $('[data-toggle="popover"]').popover('show'); 
});
$('[data-toggle="popover"]').focusout(function() { 
   $('[data-toggle="popover"]').popover('hide'); 
});
</script>



