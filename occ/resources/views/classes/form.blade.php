<div class="form-group{{ $errors->has('session') ? ' has-error' : '' }}">
    {!! Form::label('session', 'Session', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('session', null, ['class' => 'form-control']) !!}
        @if ($errors->has('session'))
        <span class="help-block">
            <strong>{{ $errors->first('session') }}</strong>
        </span>
        @endif
    </div>
</div>
@if(Request::is('classes/create'))
<div class="form-group{{ $errors->has('class_details_id') ? ' has-error' : '' }}">
    <label for="class_details_id" class="control-label col-md-4">Title
    </label>
    <div class="col-md-6">
        {!! Form::select('class_details_id', $class_details, null, ['class' => 'form-control', 'id' => 'class-details-select']) !!}
        @if ($errors->has('class_details_id'))
        <span class="help-block">
            <strong>{{ $errors->first('class_details_id') }}</strong>
        </span>
        @endif
    </div>
</div>
@else
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        @if(isset($classes))
        {!! Form::text('title', $classes->details->title, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        @else
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        @endif
        @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif
    </div>
</div>
@endif
<div class="form-group{{ $errors->has('entrance') ? ' has-error' : '' }}">
    {!! Form::label('entrance', 'entrance', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('entrance', null, ['class' => 'form-control']) !!}
        @if ($errors->has('entrance'))
        <span class="help-block">
            <strong>{{ $errors->first('entrance') }}</strong>
        </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('day_of_week') ? ' has-error' : '' }}">
    {!! Form::label('day_of_week', 'Day of Week', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('day_of_week', null, ['class' => 'form-control']) !!}
        @if ($errors->has('day_of_week'))
        <span class="help-block">
            <strong>{{ $errors->first('day_of_week') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
    {!! Form::label('time', 'Time', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('time', null, ['class' => 'form-control']) !!}
        @if ($errors->has('time'))
        <span class="help-block">
            <strong>{{ $errors->first('time') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('begin_date') ? ' has-error' : '' }}">
    {!! Form::label('begin_date', '1st Day of Class ', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::input('date','begin_date', null, ['class' => 'form-control']) !!}
        @if ($errors->has('begin_date'))
        <span class="help-block">
            <strong>{{ $errors->first('begin_date') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
    {!! Form::label('end_date', 'Last Day of Class ', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::input('date','end_date', null, ['class' => 'form-control']) !!}
        @if ($errors->has('end_date'))
        <span class="help-block">
            <strong>{{ $errors->first('end_date') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
    {!! Form::label('capacity', 'Max amount of students (Initial Vacany)', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
        @if ($errors->has('capacity'))
        <span class="help-block">
            <strong>{{ $errors->first('capacity') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('is_open') ? ' has-error' : '' }}">
    {!! Form::label('is_open', 'Is active and available for class sign up?', ['class' => 'control-label col-md-4']) !!}
    <div class="col-md-6">
        
        {!! Form::select('is_open', array('yes' => 'yes', 'no' => 'no'), ['class' => 'form-control']) !!}
        @if ($errors->has('is_open'))
        <span class="help-block">
            <strong>{{ $errors->first('is_open') }}</strong>
        </span>
        @endif
    </div>
</div>
<?php $idx = 1 ?>
@if (isset($classes))
@foreach ($classes->instructors as $instructor)
<div class="form-group{{ $errors->has('instructor') ? ' has-error' : '' }}">
    <label for="instructors" class="control-label col-md-4">Instructor {{ $idx }}
        <a href="#" data-toggle="tooltip" title="Remove Instructor">
        <span class="glyphicon glyphicon-remove remove-inst" aria-hidden="true" id="remove-inst"></span>
        </a>
    </label>
    <div class="col-md-6">
        {!! Form::select('instructors[]', $instructors, $instructor->id, ['class' => 'form-control', 'id' => 'inst-select']) !!}
        @if ($errors->has('instructor'))
        <span class="help-block">
            <strong>{{ $errors->first('instructor') }}</strong>
        </span>
        @endif
    </div>
</div>
<?php $idx++ ?>
@endforeach
@else
<div class="form-group{{ $errors->has('instructor') ? ' has-error' : '' }}">
    <label for="instructors" class="control-label col-md-4">Instructor {{ $idx }}
        <a href="#" data-toggle="tooltip" title="Remove Instructor">
        <span class="glyphicon glyphicon-remove remove-inst" aria-hidden="true" id="remove-inst"></span>
        </a>
    </label>
    <div class="col-md-6">
        {!! Form::select('instructors[]', $instructors, null, ['class' => 'form-control', 'id' => 'inst-select']) !!}
        @if ($errors->has('instructor'))
        <span class="help-block">
            <strong>{{ $errors->first('instructor') }}</strong>
        </span>
        @endif
    </div>
</div>
@endif

<div id='place-holder'></div>

<div class="form-group">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <div class='btn btn-primary pull-right' onclick="AddNewInstructor()">Add another Instructor</div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        {!! Form::submit($submitButtonLabel, ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>

<script type="text/javascript">
    function AddNewInstructor() {
        var opts = $('#inst-select')[0].options;
        var inst_id = $.map(opts, function(elem) {
            return (elem.value);
        });

        var inst_name = $.map(opts, function(elem) {
            return (elem.text);
        });

        var frm_grp = $('<div></div>').addClass('form-group');
        var lbl = $('<label for="instructors"></label').addClass('control-label col-md-4').text('New Instructor');
        var dv_input = $('<div></div>').addClass('col-md-6');
        var select_dom = $('<select></select>').addClass('form-control').attr('name', 'instructors[]');
        var remove_ref = $('<a href="#"></a>').attr('data-togggle', 'tooltip').attr('title', 'Remove Instructor');

        var remove_glyph = $('<span></span>').addClass('glyphicon glyphicon-remove remove-inst').attr('aria-hidden', 'true').attr('id', 'remove-inst');
        remove_ref.append(remove_glyph);
        lbl.append(remove_ref);
        for (var i = 0; i < inst_id.length; i++) {
            var option = $('<option></option').attr('value', inst_id[i]).text(inst_name[i]);
            select_dom.append(option);
        }
        dv_input.append(select_dom);
        frm_grp.append(lbl);
        frm_grp.append(dv_input);

        $('#place-holder').append(frm_grp);
    }

    $('body').on('click', '#remove-inst', function () {
        $(this).parent().parent().parent().remove();
    });

     $('[data-toggle="tooltip"]').tooltip();

</script>




