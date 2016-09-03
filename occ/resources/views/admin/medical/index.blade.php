@extends('admin.admin_toolbar')

@section('title', 'Admin: Class Schedule')


@section('content')
@include('info_pop_ups.info_flash')
<div class="container-fluid">
<div class="row">
	<h2>Medical Records Dashboard</h2>
</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-6">
			<ul class="pagination pagination-lg pull-right">
				@for ($i = 1; $i <= $num_of_pages; $i++)
				<li class= <?php if($i == $curr_page) echo "active"; ?> ><a href="{{ $i }}"> {{$i}}</a></li>
				@endfor
			</ul>
		</div>
	</div>
	<div class="spacer-sm" style="margin-top:20px;"></div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			@foreach ($users as $user)
			<div class="well well-sm " style="background-color: rgb(30,174,30); color: rgb(255,255,255)">
			<h4>
				{{$user->user_profile->first_name . ' '. $user->user_profile->last_name . '\'s Registered Pets   '}}
			</h4>
				<p>{{$user->email}}</p>
			</div>
			<table class="table  table-hover table-responsive">
				<tr>
					<th>Dog's Name</th>
					<th>Record Uploaded on</th>
					<th>Record Verified ?</th>
					<th>Shots Expire On</th>
					<th>Record is Hardcopy</th>
					<th></th>
					<th></th>
				</tr>
				<tbody>
					@foreach ($user->pets as $pet)

					@foreach ($pet->med_records as $record)
					<tr  class={{ isset($record->shots_verified) ? 'danger' : 'info'}}>
						<td>{{$pet->name}}</td>
						<td>{{$record->updated_at}}</td>
						<td>{{$record->shots_verified == 0 ? 'Not Verified Yet' : 'Yes'}}</td>
						<td>{{$record->shots_expire}}</td>
						<td>{{isset($record->record_is_hardcopy) ? 'Yes' : 'No'}}</td>
						<td><a class="btn btn-primary btn-sm" href="{{ url('/download_med_rec/' . $record->id) }}">Download Medical Record</a></td>
						<td><a class="btn btn-warning btn-sm" href="{{ route('medical_record.edit', $record->id) }}" role="button">Verify Record</a>
						</td>
					</tr>
					@endforeach
					@endforeach
				</tbody>
			</table>
			@endforeach
		</div>
	</div>
</div>
@endsection