    
<div class="panel panel-primary">
    <div class="panel-heading">Mailing Address</div>
    <div class="panel-body">

        <div class="form-group{{ $errors->has('street_address') ? ' has-error' : '' }}">
            {!! Form::label('street_address', 'Street Address', ['class' => 'control-label col-md-4']) !!}

            <div class="col-md-6">
                {!! Form::text('street_address', null, ['class' => 'form-control']) !!}

                @if ($errors->has('street_address'))
                <span class="help-block">
                    <strong>{{ $errors->first('street_address') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            {!! Form::label('city', 'City', ['class' => 'control-label col-md-4']) !!}

            <div class="col-md-6">
                {!! Form::text('city', null, ['class' => 'form-control']) !!}

                @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
            {!! Form::label('state', 'state', ['class' => 'control-label col-md-4']) !!}

            <div class="col-md-3">
                {!! Form::select('state', $states, $user_profile->state,['class' => 'form-control']) !!}
                @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
            {!! Form::label('zip', 'Zip', ['class' => 'control-label col-md-4']) !!}

            <div class="col-md-6">
                {!! Form::text('zip', null, ['class' => 'form-control']) !!}

                @if ($errors->has('zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip') }}</strong>
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
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Registered Phone Numbers</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Phone Type</th>
                            <th></th>
                        </tr>    
                    </thead>
                    <tbody>
                        @foreach($user_profile->phone_numbers as $phone_number)
                        <tr>
                            <td> {{ $phone_number->number }}</td>
                            <td> {{ $phone_number->type }} </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('phone_numbers.edit', $phone_number->id) }}" role="button">Edit</a>
                                <a class="btn btn-danger btn-sm jq-postback"  href="{{ route('phone_numbers.destroy', $phone_number->id) }}" data-method="delete" role="button">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 col-md-offset-3">
                <a class="btn btn-primary btn-sm" href="{{ url('/phone_numbers/create') }}" role="button">Add a new phone number</a>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('js/user_profile.js') }}"></script>
