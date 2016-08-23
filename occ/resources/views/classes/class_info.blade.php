@extends('layouts.app')


@section('content')

@section('title', 'Class Information')

@include('classes.class_nav_bar')
<div class="row">
	<div class="col-md-1"></div>

	<div class="col-md-10">
	<p class="lead">Below are progression charts and details for the classes offered by the Obedience Club of Chattanooga.  All Classes are 1 day per week and 6 week long courses.  All Courses <strong> MUST </strong>be taken in order unless an instructor has evaluated your dog and approves an exemption.</p>
	@include('classes.class_charts')
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			@foreach ($class_details as $detail)
			@if ($detail->is_active == 1)
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading{{$number}}">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$number}}" aria-expanded="false" aria-controls="collapse{{$number}}">
							{{ $detail->title }}
							<span class="caret"></span>	
						</a>
					</h4>
				</div>
				<div id="collapse{{$number}}" class="panel-collapse {{$number == 1 ? 'collapse in' : 'collapse'}}" role="tabpanel" aria-labelledby="heading{{$number}}">
					<div class="panel-body">
						@if (count($detail->pre_reqs) == 1)
						<h4> Prerequisite Class: <small> {{ $detail->pre_reqs[0]->title }} </small></h4>

						@elseif (count($detail->pre_reqs) > 1)
						<h4> Prerequisite Class: <small>

							@for ($i = 0; $i < count($detail->pre_reqs); $i++)
								@if ($i + 1 == count($detail->pre_reqs))
								{{ $detail->pre_reqs[$i]->title   }} 
								@else
								{{ $detail->pre_reqs[$i]->title . ' ' }} <b>or</b> {{ ' ' }}
								@endif
							@endfor
						</small></h4>

						@endif
						<h4>Cost: <small> ${{$detail->cost - $regular_mmbrshp_discount}} for Regular Members, ${{$detail->cost - $student_mmbrshp_discount}} for Student Members</small></h4>
						<h4>Minimum Age <small> 
							@if ($detail->minimum_age_requirement >= 12)
							{{ $detail->minimum_age_requirement / 12  . ' years' }}

							@elseif ($detail->minimum_age_requirement < 12)
							{{$detail->minimum_age_requirement * 1 . ' months' }}
							@endif
						</small></h4>
						@if ($detail->maximum_age_requirement < 90)
						<h4>Maximum Age <small> 
							@if ($detail->maximum_age_requirement >= 12)
							{{ $detail->maximum_age_requirement / 12  . ' years' }}

							@elseif ($detail->maximum_age_requirement < 12)
							{{$detail->maximum_age_requirement * 1 . ' months' }}
							@endif
						</small></h4>
						@endif
						<h4> Description </h4>
						<p>	{{ $detail->description }} </p>
					</div>
				</div>
			</div>
			<?php $number = $number + 1; ?>
			@endif
			@endforeach
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
@endsection


