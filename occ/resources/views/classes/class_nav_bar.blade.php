<div class="page-header">
	<center><h2>@yield('title')</h2></center>
</div>

<?php $curr_view =  Route::getCurrentRoute()->getPath(); ?>
@if ($curr_view == 'classes_schedule/{page_schedule}')

<ul class="nav nav-tabs">
  <li role="presentation"><a href="/class_info">Class Information</a></li>
  <li role="presentation"><a href="/pre_class_prep">Pre-Class Prep</a></li>
  <li role="presentation" class="active"><a href="/classes_schedule/1">Class Schedule</a></li>
</ul>

@elseif ($curr_view == 'pre_class_prep')

<ul class="nav nav-tabs">
  <li role="presentation"><a href="/class_info">Class Information</a></li>
  <li role="presentation" class="active"><a href="/pre_class_prep">Pre-Class Prep</a></li>
  <li role="presentation"><a href="/classes_schedule/1">Class Schedule</a></li>
</ul>


@else

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="/class_info">Class Information</a></li>
  <li role="presentation"><a href="/pre_class_prep">Pre-Class Prep</a></li>
  <li role="presentation"><a href="/classes_schedule/1">Class Schedule</a></li>
</ul>

@endif

<div class="spacer-md"></div>
