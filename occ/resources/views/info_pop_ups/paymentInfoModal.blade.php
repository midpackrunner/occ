<div class="modal fade" id="payment-method-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Payment Options</h4>
      </div>
      <div class="modal-body">
        <dl>
          <dt>PayPal</dt>
          <dl>After clicking the 

          @if(Request::is('register'))
          <em>Register</em> 
          @elseif(Request::is('class_sign_up/*'))
          <em>Sign Up</em> 
          @else
          <em>Submit</em> 
          @endif
          , Button you will be redirected to pay using PayPal.
            The OCC website does not store any of your credit card information.
          </dl>
        </dl>
        <dl>
          <dt>Check</dt>
          <dl>
            If electing to pay by check, you can either mail the check to the address given below OR you
            can drop the check off at our location.
          </dl>
        </dl>
        @if(Request::is('class_sign_up/*'))
        <dl>
          <dt>Volunteer Hours</dt>
          <dl>
            Volunteer Hours can be used towards signing up for classes.  You <strong>must</strong> have a total of 6 hours in order to use this <i>time for time</i> benefit.  Volunteer hours are non-redeemable.
          </dl>
        </dl>
        @endif
        <address>
            <h5>Mail checks to:</h5>
          <strong>OCC Training Director: Susan Millican</strong><br>
          1622 Back Valley Road<br>
          Trenton, GA 30752<br>
          (423)401-8916
        </address>
        <p><em><strong>Worried you will not remember the address?</strong></em> Don't worry.
            You can always check out our contact and location information by clicking on <em><strong>Contact Us</strong></em>
            on our home page.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Got It!</button>
      </div>
    </div>
  </div>
</div>