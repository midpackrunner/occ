@extends('layouts.app')


@section('content')
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="detail-heading">
				<h4 class="panel-title">
					{{ $class_detail->title }}
				</h4>
			</div>
			<div class="panel-body">
				@if (count($class_detail->pre_reqs) == 1)
				<h4> Prerequisite Class: <small> {{ $class_detail->pre_reqs[0]->title }} </small></h4>

				@elseif (count($class_detail->pre_reqs) > 1)
				<h4> Prerequisite Class: <small>

					@for ($i = 0; $i < count($class_detail->pre_reqs); $i++)
					@if ($i + 1 == count($class_detail->pre_reqs))
					{{ $class_detail->pre_reqs[$i]->title   }} 
					@else
					{{ $class_detail->pre_reqs[$i]->title . ' ' }} <b>or</b> {{ ' ' }}
					@endif
					@endfor
				</small></h4>

				@endif
				<h4>Cost: <small> ${{$class_detail->cost - 5}} for Regular Members, ${{$class_detail->cost}} for Student Members</small></h4>
				<h4>Minimum Age <small> 
					@if ($class_detail->minimum_age_requirement >= 12)
					{{ $class_detail->minimum_age_requirement / 12  . ' years' }}

					@elseif ($class_detail->minimum_age_requirement < 12)
					{{$class_detail->minimum_age_requirement * 1 . ' months' }}
					@endif
				</small></h4>
				@if ($class_detail->maximum_age_requirement < 90)
				<h4>Maximum Age <small> 
					@if ($class_detail->maximum_age_requirement >= 12)
					{{ $class_detail->maximum_age_requirement / 12  . ' years' }}

					@elseif ($class_detail->maximum_age_requirement < 12)
					{{$class_detail->maximum_age_requirement * 1 . ' months' }}
					@endif
				</small></h4>
				@endif
				<h4> Description </h4>
				<p>	{{ $class_detail->description }} </p>
				<div class='pull-right'><a href="/classes_schedule/1">Back to Class Schedule</a></div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
@endsection