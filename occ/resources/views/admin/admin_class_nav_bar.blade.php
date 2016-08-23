<div class="page-header">
	<center><h2>@yield('title')</h2></center>
</div>

<?php $curr_view =  Route::getCurrentRoute()->getPath(); ?>

@if ($curr_view == 'class_details')

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="/class_details">Class Details</a></li>
  <li role="presentation" ><a href="/classes_full_list/1">Class Schedule</a></li>
</ul>

@else

<ul class="nav nav-tabs">
  <li role="presentation"><a href="/class_details">Class Information</a></li>
  <li role="presentation" class="active"><a href="/classes">Class Schedule</a></li>
</ul>


@endif

<div class="spacer-md"></div>