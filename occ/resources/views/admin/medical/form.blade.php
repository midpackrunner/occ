{{ Form::hidden('filter', $filter) }}
{{ Form::hidden('curr_page', $curr_page) }}


<div class="form-group{{ $errors->has('shots_verified') ? ' has-error' : '' }}">
    {!! Form::label('shots_verified', 'Verified', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::select('shots_verified', array('1' => 'Yes', '0' => 'No'), null, ['class' => 'form-control']) !!}
        @if ($errors->has('shots_verified'))
        <span class="help-block">
            <strong>{{ $errors->first('shots_verified') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('shots_expire') ? ' has-error' : '' }}">
    {!! Form::label('shots_expire', 'Shots Expire On: ', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::input('date','shots_expire', date('Y-m-d'), ['class' => 'form-control']) !!}
        @if ($errors->has('shots_expire'))
        <span class="help-block">
            <strong>{{ $errors->first('shots_expire') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('record_is_hardcopy') ? ' has-error' : '' }}">
    {!! Form::label('record_is_hardcopy', 'Is this Record stored online?', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::select('record_is_hardcopy', array('0' => 'Yes', '1' => 'No'), $hardcopy_default, ['class' => 'form-control', 'id' => 'rec-hardcopy']) !!}
        @if ($errors->has('record_is_hardcopy'))
        <span class="help-block">
            <strong>{{ $errors->first('record_is_hardcopy') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group" id="upload-form-group">
    <label class="control-label col-md-8 ">Would you like to upload the pet's vaccination records at this time?</label>
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
        if ($("#rec-hardcopy").val() == 1) {
            $("#upload-form-group").show();
        } else {

            $("#upload-form-group").hide();
        }

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
        $("#rec-hardcopy").on('change', function() {
            console.log($(this).val());
            if ($(this).val() == 1) {
                $("#upload-form-group").show(250);
            } else {
                $("#upload-form-group").hide(250);
            }
        });

        if($("#rec-hardcopy").hasClass("has-error")) {
            $("#rec-hardcopy").show();
        }

    });
</script>

