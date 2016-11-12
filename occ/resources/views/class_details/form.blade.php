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
    {!! Form::label('minimum_age_requirement', 'Minimum Age Req. (in months)', ['class' => 'control-label col-md-4']) !!}
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
    {!! Form::label('maximum_age_requirement', 'Maximum Age Req. (in months)', ['class' => 'control-label col-md-4']) !!}
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

<?php $idx = 1 ?>
@if (isset($classes_details))
@foreach ($classes_details->pre_reqs as $pre_req)
<div class="form-group{{ $errors->has('pre_req') ? ' has-error' : '' }}">
    <label for="pre_reqs" class="control-label col-md-4">Prerequisite {{ $idx }}
        <a href="#" data-toggle="tooltip" title="Remove pre_req">
        <span class="glyphicon glyphicon-remove remove-prereq" aria-hidden="true" id="remove-prereq"></span>
        </a>
    </label>
    <div class="col-md-6">
        {!! Form::select('pre_reqs[]', $pre_reqs, $pre_req->id, ['class' => 'form-control', 'id' => 'prereq-select']) !!}
        @if ($errors->has('pre_req'))
        <span class="help-block">
            <strong>{{ $errors->first('pre_req') }}</strong>
        </span>
        @endif
    </div>
</div>
<?php $idx++ ?>
@endforeach
@else
<div class="form-group{{ $errors->has('pre_req') ? ' has-error' : '' }}">
    <label for="pre_reqs" class="control-label col-md-4">Prerequisite {{ $idx }}
        <a href="#" data-toggle="tooltip" title="Remove pre_req">
        <span class="glyphicon glyphicon-remove remove-prereq" aria-hidden="true" id="remove-prereq"></span>
        </a>
    </label>
    <div class="col-md-6">
        {!! Form::select('pre_reqs[]', $pre_reqs, null, ['class' => 'form-control', 'id' => 'prereq-select']) !!}
        @if ($errors->has('pre_req'))
        <span class="help-block">
            <strong>{{ $errors->first('pre_req') }}</strong>
        </span>
        @endif
    </div>
</div>
@endif

<div id='place-holder'></div>

<div class="form-group">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <div class='btn btn-primary pull-right' onclick="AddPreReq()">Add Prerequisite</div>
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

    var pre_req = <?php echo json_encode($pre_reqs); ?>;
    var prereq_id = [];
    var prereq_title = [];

    $( document ).ready(function() {
        for (var i = 0; i < Object.keys(pre_req).length; i++) {
            prereq_id[i] = Object.keys(pre_req)[i];
            prereq_title[i] = pre_req[Object.keys(pre_req)[i]];

        }
    });

    function AddPreReq() {
        var frm_grp = $('<div></div>').addClass('form-group');
        var lbl = $('<label for="pre_reqs"></label').addClass('control-label col-md-4').text('New Prerequisite');
        var dv_input = $('<div></div>').addClass('col-md-6');
        var select_dom = $('<select></select>').addClass('form-control').attr('name', 'pre_reqs[]');
        var remove_ref = $('<a href="#"></a>').attr('data-togggle', 'tooltip').attr('title', 'Remove Prerequisite');

        var remove_glyph = $('<span></span>').addClass('glyphicon glyphicon-remove remove-prereq').attr('aria-hidden', 'true').attr('id', 'remove-prereq');
        remove_ref.append(remove_glyph);
        lbl.append(remove_ref);
        for (var i = 0; i < prereq_id.length; i++) {
            var option = $('<option></option').attr('value', prereq_id[i]).text(prereq_title[i]);
            select_dom.append(option);
        }
        dv_input.append(select_dom);
        frm_grp.append(lbl);
        frm_grp.append(dv_input);

        $('#place-holder').append(frm_grp);
    }

    $('body').on('click', '#remove-prereq', function () {
        $(this).parent().parent().parent().remove();
    });

     $('[data-toggle="tooltip"]').tooltip();
</script>



