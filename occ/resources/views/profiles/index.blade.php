@extends('admin.admin_toolbar')


@section('content')
<h1>Members Dashboard</h1>
<div class="row">
	<div class="col-md-6">
		<h4 class="text-info">Filter By:</h4>
		<a class="btn btn-info btn-sm" href="{{ url('/members/1/' . 'expired_membership') }}">Expired Memberships</a>
		<a class="btn btn-info btn-sm" href="{{ url('/members/1/' . 'regular_membership') }}">Regular Memberships</a>
		<a class="btn btn-info btn-sm" href="{{ url('/members/1/' . 'student_membership') }}">Student Memberships</a>
		<a class="btn btn-info btn-sm" href="{{ url('/members/1/' . 'none') }}">Show All</a>
	</div>
</div>
<div class="spacer-sm"></div>
<div class="row">
	<div class="col-md-6">
	<a class="btn btn-primary btn-sm" href="{{ url('/download_members/' . $filter) }}">Download List</a>
	</div>
	<div class="col-md-6">
		<ul class="pagination pagination-lg pull-right">
			@for ($i = 1; $i <= $num_of_pages; $i++)
			<li class= <?php if($i == $curr_page) echo "active"; ?> ><a href="{{ url('/members/'. $i . '/' . $filter) }}"> {{$i}}</a></li>
			@endfor
			<?php $i=1; ?>
		</ul>
	</div>
</div>

<div class="row">

	<div class="col-md-12">
		<table class="table table-striped table-hover table-responsive">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Membership Type</th>
				<th>Membership Expiration</th>
				<th>Renew Membership</th>
				<th></th>
			</tr>
			@foreach ($user_profiles as $user_profile)
			<tr>
				<td> {{ $user_profile->first_name }}</td>
				<td> {{ $user_profile->last_name }}</td>
				<td> {{ $user_profile->user->email }}</td>

				@if ($user_profile->membership != null)
				@if ($user_profile->membership->end_date > $now)
				<td>{{ ucfirst($user_profile->membership->membership_type->name) }}</td>
				<td>{{ ucfirst($user_profile->membership->end_date) }}</td>
				@else
				<td class="text-danger">Membership has Expired!</td>
				<td class="text-danger">{{ ucfirst($user_profile->membership->end_date) }}</td>
				@endif
				@else
				<td class="text-danger">UnKnown Membership status</td>
				<td class="text-danger">Error: 631</td>
				@endif

				<td>
					<a  href="{{ route('admin.update_membership', $user_profile->id) }}" role="button">Click to renew</a>
				</td>
				<td>
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$i}}">User Details</button>
				</td>
			</tr>
			<?php $i++ ?>	
			@endforeach
		</table>
	</div>
</div>

<?php $i=1 ?>	
@foreach ($user_profiles as $user_profile)
<div id="myModal{{$i}}" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">{{$user_profile->first_name . " " . $user_profile->last_name . "'s Contact Info and Registered Dogs"}}</h4>
			</div>
			<div class="modal-body">
				<dl class="dl-horizontal">
					<dt>Phone Number(s):</dt>
					@foreach($user_profile->phone_numbers as $number)
					<dd>
						{!! $number->number !!} ({!! $number->type !!})
					</dd>
					<dd>

					</dd>
					@endforeach
				</dl>
				<dl class="dl-horizontal">
					<dt>Address:</dt>
					<dd>
						<address>
							{!! $user_profile->street_address !!} <br/>
							{!! $user_profile->city !!}, {!! $user_profile->state !!}, 
							{!! $user_profile->zip !!} 
						</address>
					<dd>
				</dl>
				@if (count($user_profile->interests) != 0)
				<dl class="dl-horizontal">
					<dt>Interests:</dt>
					@foreach($user_profile->interests as $interest)
					<dd>
					 {{$interest->name }}
					</dd>
					@endforeach
				</dl>
				@endif 
				<dl class="dl-horizontal">
					<dt>Registered Dogs:</dt>    <!-- This is WRONG -->
					@foreach($user_profile->user->pets as $pet)
					<dd>
					 {{$pet->name   . ' Birthdate: ' . $pet->birth_date }}
					</dd>
					@endforeach
				</dl>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<?php $i++ ?>	

	@endforeach



	@endsection