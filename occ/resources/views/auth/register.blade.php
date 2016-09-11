@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Membership Registration</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">First Name</label>

              <div class="col-md-6">
                <input type="first_name" class="form-control" name="first_name" value="{{ old('first_name') }}">

                @if ($errors->has('first_name'))
                <span class="help-block">
                  <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Last Name</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                @if ($errors->has('last_name'))
                <span class="help-block">
                  <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            

            <div class="form-group{{ $errors->has('street_address') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Street Address</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="street_address" value="{{ old('street_address') }}">

                @if ($errors->has('street_address'))
                <span class="help-block">
                  <strong>{{ $errors->first('street_address') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">City</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="city" value="{{ old('city') }}">

                @if ($errors->has('city'))
                <span class="help-block">
                  <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">State</label>

              <div class="col-md-3">
                <select class="form-control"  name="state" required="required">
                  @foreach($states as $state)
                  <option value="{{ $state->abbrv }}" @if (old('state') == $state->abbrv) selected="selected" @endif>{{ $state->state }}</option>
                  @endforeach 
                </select>
                

                @if ($errors->has('state'))
                <span class="help-block">
                  <strong>{{ $errors->first('state') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Zip</label>

              <div class="col-md-3">
                <input type="text" class="form-control" name="zip" value="{{ old('zip') }}">

                @if ($errors->has('zip'))
                <span class="help-block">
                  <strong>{{ $errors->first('zip') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Primary Phone Number</label>

              <div class="col-md-6">
                <input type="text" id="primary-phone-number"class="form-control" name="phone_number" value="{{ old('phone_number') }}">


                @if ($errors->has('phone_number'))
                <span class="help-block">
                  <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('phone_type') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Phone Number Type</label>

              <div class="col-md-2">
                <select class="form-control selectpicker" name="phone_type">

                  <option value="mobile" @if (old('phone_type') == "mobile") selected="selected" @endif>Mobile</option>
                  <option value="home" @if (old('phone_type') == "home") selected="selected" @endif>Home</option>
                  <option value="work" @if (old('phone_type') == "work") selected="selected" @endif>Work</option>
                </select>

                @if ($errors->has('phone_type'))
                <span class="help-block">
                  <strong>{{ $errors->first('phone_type') }}</strong>
                </span>
                @endif
              </div>
            </div>

            

            <div class="form-group">
              <label class="col-md-6 control-label">Will you volunteer to help with the Club? <small>Volunteer hours can be used to take classes</small></label>

              <div class="col-md-6">
                <label class="radio-inline"><input type="radio" name="willing_to_work" value="yes" checked>Yes</label>
                <label class="radio-inline"><input type="radio" name="willing_to_work" value="no">No</label>
              </div>
            </div>

            <div class="form-group">
              <div id="areas-of-interest" class="form-group{{ $errors->has('interests') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Please indicate your committees of interest(s)</label>
                <div class="col-md-8">
                  @foreach ($interests_list as $interest_item)
                  <label class="checkbox-inline">
                    {{ Form::checkbox('interests[]', $interest_item->id)}} {{ $interest_item->name}}
                  </label>    
                  @endforeach 
                </div>  
                @if ($errors->has('interest'))  
                <span class="help-block">   
                  <strong>{{ $errors->first('interest') }}</strong>   
                </span> 
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label for="skills"class="col-md-10 col-md-offset-1">Do you have special skills that you can offer the Club?</label>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  {{Form::textarea('special_skills', null, ['id' => 'skills', 'class' => 'form-control'])}}
                  
                </div>
              </div>
            </div>

            @include('info_pop_ups.membershipInfoModal')

            <div class="form-group {{ $errors->has('membership_type') ? 'has-error' : ''}}">
              <label class="col-md-4 control-label">Membership Types: 
                <span data-toggle="modal" data-target="#membershipInfoModal"class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
              </label>

              <div class="col-md-6">
                @foreach ($membership_types as $membership_type)
                <label class="radio-inline">
                  {{ Form::radio('membership_type', $membership_type->id, false, ['class' => 'memberships'])}} {{$membership_type->name}}
                </label>
                @endforeach

                @if ($errors->has('membership_type'))
                <span class="help-block">
                  <strong>{{ $errors->first('membership_type') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="sponsors form-group{{ $errors->has('sponsor1') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Member Sponsor's Name (1)</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="sponsor1" value="{{ old('sponsor1') }}">

                @if ($errors->has('sponsor1'))
                <span class="help-block">
                  <strong>{{ $errors->first('sponsor1') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class=" sponsors form-group{{ $errors->has('sponsor2') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Member Sponsor's Name (2)</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="sponsor2" value="{{ old('sponsor2') }}">

                @if ($errors->has('sponsor2'))
                <span class="help-block">
                  <strong>{{ $errors->first('sponsor2') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('rev_resource') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">How did you here about Us?</label>

              <div class="col-md-3">
                <select class="form-control" id="rev-resource" name="rev_resource" required="required">
                  @foreach($rev_resources as $rev_resource)
                  <option value="{{ $rev_resource->resource }}" @if (old('rev_resource') == $rev_resource->resource) selected="selected" @endif>{{ $rev_resource->resource }}</option>
                  @endforeach 
                </select>
                
                @if ($errors->has('rev_resources'))
                <span class="help-block">
                  <strong>{{ $errors->first('rev_resources') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class=" hear-about-us-details form-group{{ $errors->has('survey_details') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label" id="rev-resource-lbl">Other Source: </label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="survey_details" value="{{ old('survey_details') }}">

                @if ($errors->has('survey_details'))
                <span class="help-block">
                  <strong>{{ $errors->first('survey_details') }}</strong>
                </span>
                @endif
              </div>
            </div>




            <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : ''}}">
              <label class="col-md-4 control-label">Payment Method: 
                <span data-toggle="modal" data-target="#payment-method-info"class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
              </label>

              @include('info_pop_ups.paymentInfoModal')
              <div class="col-md-6">
                @foreach ($payment_methods as $payment_method)
                <label class="radio-inline">
                 {{ Form::radio('payment_method', $payment_method)}} {{$payment_method}}
               </label>
               @endforeach

               @if ($errors->has('payment_method'))
               <span class="help-block">
                <strong>{{ $errors->first('payment_method') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
              <input type="password" class="form-control" name="password">

              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-6"><h6>(Must contain one uppercase, one numerical value, and be 8 characters long)</h6></div>
          </div>

          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
              <input type="password" class="form-control" name="password_confirmation">

              @if ($errors->has('password_confirmation'))
              <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Register
              </button>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- end of panel -->
  </div>
</div>
</div>

<script src="{{ asset('js/register.js') }}"></script>
@endsection
