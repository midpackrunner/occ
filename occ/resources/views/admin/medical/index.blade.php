@extends('admin.admin_toolbar')

@section('title', 'Admin: Class Schedule')


@section('content')
@include('info_pop_ups.info_flash')
<style type="text/css">
	.well-danger {
		background-color: rgb(247,125,106); 
		color: rgb(255,255,255);

	}
	.well-primary {
		background-color: rgb(30,174,30); 
		color: rgb(255,255,255);
	}
</style>
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
			<div class="well well-sm {{($user->count_pets_with_expired_shots() > 0) ? 'well-danger': 'well-primary'}}">
				<h4>
					{{$user->user_profile->first_name . ' '. $user->user_profile->last_name . '\'s Registered Pets   '}}
					<small style="color: rgb(255,255,255)">{{$user->email}} 
					</small>
						<button class="pull-right btn {{($user->count_pets_with_expired_shots() > 0) ? 'btn-danger': 'btn-primary'}}"type="button" data-toggle="collapse" data-target="#dropdown_{{$user->user_profile->last_name. $user->user_profile->last_name}}" aria-expanded="false" aria-controls="dropdown_{{$user->email}}">
							<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
						</button>
				</h4>
			</div>
			<div class="collapse" id="dropdown_{{$user->user_profile->last_name. $user->user_profile->last_name}}">
				<div class="row">
				<div class="col-md-11 col-md-offset-1">

				<a class="pull-right btn btn-primary btn-sm" href="{{ route('medical_record.create', $user->id) }}" role="button">Create Verification Record</a>
				</div>
				</div>
				<div class="spacer-sm"></div>
				<table class="table  table-hover table-responsive">
					<tr>  
						<th>Dog's Name</th>
						<th>Record Uploaded on</th>
						<th>Record Verified ?</th>
						<th>Shots Expire On</th>
						<th>Record is Physically Filed</th>
						<th></th>
						<th></th>
					</tr>
					<tbody>
						@foreach ($user->pets as $pet)
						@if(sizeof($pet->med_records) == 0)
						<tr class="danger"><td>{{$pet->name}} does not have any medical records uploaded or verified</td></tr>
						@else
						@foreach ($pet->med_records as $record)
						<tr class={{ isset($record->shots_verified) && $record->shots_verified ? '' : 'danger'}}>
							<td>{{$pet->name}}</td>
							<td>{{$record->updated_at}}</td>
							<td>{{$record->shots_verified == 0 ? 'Not Verified Yet' : 'Yes'}}</td>
							<td>{{$record->shots_expire}}</td>
							<td>{{isset($record->record_is_hardcopy) && $record->record_is_hardcopy ? 'Yes' : 'No'}}</td>
							<td>
							@if(!$record->record_is_hardcopy )
							<a class="btn btn-primary btn-sm" href="{{ url('/download_med_rec/' . $record->id) }}">Download Medical Record</a>
							@endif
							</td>
							<td><a class="btn btn-warning btn-sm" href="{{ route('medical_record.edit', $record->id) }}" role="button">Verify Record</a>
							</td>
						</tr>
						@endforeach
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection