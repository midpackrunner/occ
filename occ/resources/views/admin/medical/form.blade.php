<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
    {!! Form::label('gender', 'Gender', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), null, ['class' => 'form-control']) !!}
        @if ($errors->has('gender'))
        <span class="help-block">
            <strong>{{ $errors->first('gender') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4">Spayed/Neutered?</label>
    <div class="col-md-6">
        @if(isset($pet))
        @if ($pet->is_spayed_neutered == 1)
        <label class="radio-inline"><input type="radio" name="is_spayed_neutered" value="1" checked>Yes</label>
        <label class="radio-inline"><input type="radio" name="is_spayed_neutered" value="0">No</label>
        @else
        <label class="radio-inline"><input type="radio" name="is_spayed_neutered" value="1">Yes</label>
        <label class="radio-inline"><input type="radio" name="is_spayed_neutered" value="0" checked>No</label>        
        @endif
        @else
        <label class="radio-inline"><input type="radio" name="is_spayed_neutered" value="1">Yes</label>
        <label class="radio-inline"><input type="radio" name="is_spayed_neutered" value="0" checked>No</label>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
    {!! Form::label('birth_date', 'Birth Date: ', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::input('date','birth_date', date('Y-m-d'), ['class' => 'form-control']) !!}
        @if ($errors->has('birth_date'))
        <span class="help-block">
            <strong>{{ $errors->first('birth_date') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('breed') ? ' has-error' : '' }}">
    {!! Form::label('breed', 'Breed', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        @if (isset($breeds))
        {!! Form::select('breed-select', $breeds, null,['class' => 'form-control', 'onchange' => 'CheckBreed(this.value);', 'id' => 'breed-select']) !!}
        {!! Form::text('breed', null, ['class' => 'form-control', 'id' => 'breed', 'style' => 'display:none;', 'placeholder' => 'Please supply a breed description of your pet']) !!}
        @else
        {!! Form::text('breed', null, ['class' => 'form-control', 'id' => 'breed']) !!}
        @endif
        @if ($errors->has('breed'))
        <span class="help-block">
            <strong>{{ $errors->first('breed') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-8 ">Would you like to upload your pet's vaccination records at this time?</label>
    <div class="col-md-4">
        <label class="radio-inline"><input class="upl_record_opt"type="radio" name="has_records" value="1" {{ $errors->has('pet_record') ? ' checked' : '' }}>Yes</label>
        <label class="radio-inline"><input class="upl_record_opt"type="radio" name="has_records" value="0" {{ $errors->has('pet_record') ? ' ' : 'checked' }}>No</label>
    </div>
</div>

<div class="form-group rec-upload {{ $errors->has('pet_record') ? ' has-error' : '' }}" hidden>
{!! Form::label('pet_record', 'Upload Pet Records', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
    {!! Form::file('pet_record', null, ['class' => 'form-control']) !!}
    @if ($errors->has('pet_record'))
        <span class="help-block">
        <strong>{{ $errors->first('pet_record') }}</strong>
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


<script>
    $(document).ready(function() {
        $(".upl_record_opt").on('change', function() {
            if ($(this).val() == 1) {
                $(".rec-upload").show(250);
            } else {
                $(".rec-upload").hide(250);
            }
        });

        if($(".rec-upload").hasClass("has-error")) {
            $(".rec-upload").show();
        }
    });
</script>

