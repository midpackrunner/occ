<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">HOW DO I REGISTER FOR A CLASS?</h3>
			</div>
			<div class="panel-body">
				<ul class="list-group">
					@if(Auth::guest())
					<li class="list-group-item list-group-item-danger">
						1. 
						<a href="{{ url('/register') }}">Become a Member</a>
						<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					</li>
					<li class="list-group-item list-group-item-danger">
						2. 
						<a href="{{ url('/register') }}">
							Add your dog(s) to your profile</a>
							<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
						</li>
						@else
						@if(Auth::user()->pets->count() != 0)
						<li class="list-group-item list-group-item-success">1. 
							<a href="{{ url('/profiles', Auth::user()->user_profile->id) }}">Become a Member</a>
							<div class="pull-right"><span class="glyphicon glyphicon-ok"></span></div>
						</li>
						<li class="list-group-item list-group-item-success">
							2. 
							<a href="{{ url('/profiles', Auth::user()->user_profile->id) }}">
								Add your dog(s) to your profile</a>
								<div class="pull-right"><span class="glyphicon glyphicon-ok"></span></div>
							</li>
							<li class="list-group-item list-group-item-success">
								3. Choose a class and click the “Sign Up!”(blue button) on the right.
								Select which dog to sign up, your payment type, and click in the box that you agree to the waiver.
							</li>
							@else
							<li class="list-group-item list-group-item-success">1. 
								<a href="{{ url('/profiles', Auth::user()->user_profile->id) }}">Become a Member</a>
								<div class="pull-right"><span class="glyphicon glyphicon-ok"></span></div>
							</li>
							<li class="list-group-item list-group-item-danger">
								2. 
								<a href="{{ url('/profiles', Auth::user()->user_profile->id) }}">
									Add your dog(s) to your profile</a>
									<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
								</li>
								@endif
								@endif
							</ul>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-5">
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
					HOW DO I SEE THE CLASSES I SIGNED UP FOR?        
					</button>
				</div>
				<div class="col-md-3"></div>

			</div>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">HOW DO I SEE THE CLASSES I SIGNED UP FOR?</h4>
						</div>
						<div class="modal-body">
							<p>1.  Log in</p>
							<p>2. Click “my profile” in the top right corner</p>
							<p>3.  Scroll down and you will see “Currently Registered Classes”</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>


