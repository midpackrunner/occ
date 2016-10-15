	<p> Please be sure to print your application and bring it to the first meeting.  <strong>We meet the first Friday of every month at 7 pm</strong>. You can find the application on your <i>my profile</i> page. </p>
	<p class="lead">
	<a class="btn btn-primary btn-lg" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Go to My Profile Page</a>
	</p>