@extends('admin.admin_toolbar')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
	<div class="page-header">
		<h1 class="text-primary">Volunteer Time Verification </h1>
	</div>
</div>
<div class="spacer-sm"></div>
<div class="row">

	<div class="col-md-12">
		<table class="table table-striped table-hover table-responsive">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Claimed Time</th>
				<th>Verification</th>
				<th>Verified By</th>
				<th></th>
			</tr>
			@foreach ($vol_hrs as $vol_hr)
			<tr data-toggle="tooltip" data-placement="top" title="Click on Claimed Time to view the volunteer's description of time claimed">
				<td> {{ $vol_hr->user_profile->first_name }}</td>
				<td> {{ $vol_hr->user_profile->last_name }}</td>
				<td> {{ $vol_hr->user_profile->user->email }}</td>
				<td><a data-toggle="modal" data-target="#descript-{{$vol_hr->id}}">
					{{ $vol_hr->hours . ' hrs. ' . $vol_hr->minutes . ' min.'}} </td>
				</a>

				
				<td>
					<a class="btn btn-warning btn-sm jq-postback"  href="{{ route('volunteer.update', $vol_hr->id) }}" data-method="Patch" role="button">{{ $vol_hr->verified ? 'Yes' : 'Not Verified'}}</a>

				</td>
				<td>{{ $vol_hr->verified_by}}</td>
				<td>
					<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{$vol_hr->id}}">
						Delete
					</button>
				</td>
			</tr>

			<!-- Modal -->
			<div class="modal fade" id="delete-{{$vol_hr->id}}">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title text-warning">Warning</h4>
						</div>
						<div class="modal-body">
							<p class="test-warning">Are you sure you want to delete these claimed volunteer hours?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<a class="btn btn-danger btn-sm jq-postback"  href="{{ route('volunteer.destroy', $vol_hr->id) }}" data-method="delete" role="button">Delete</a>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- Modal -->
			<div class="modal fade" id="descript-{{$vol_hr->id}}">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title text-warning">Claimed Hour(s) Description</h4>
						</div>
						<div class="modal-body">
							<p class="test-info">{{$vol_hr->description}}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Got It!</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			@endforeach
		</table>
	</div>
</div>


<div class="modal fade" id="verified">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-warning">Verified</h4>
			</div>
			<div class="modal-body">
				<p class="test-info">Claimed Volunteer Hours have been marked as verified</p>
			</div>
			<div class="modal-footer">
				<button id='got-it'type="button" class="btn btn-secondary" data-dismiss="modal">Got It!</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(document).on('click', 'a.jq-postback', function(e) {
	    e.preventDefault(); // does not go through with the link.
	    var $this = $(this);
	    console.log($this.data('method'));
	    console.log($this.attr('href'));

	    $.post({
	    	type: $this.data('method'),
	    	url: $this.attr('href')
	    }).done(function (data) {
	    	if(data == 'forbidden') {
	    		alert('Forbidden: You do not have rights to delete');
	    	}    
	    	else if (data == 'success'){
	    		console.log('success back');
	    		$('#verified').modal('show'); 
	    	}
	    	else if (data == 'delete_success'){
				location.reload();
	    	}
	    	else {
	    		alert('Unknown Error: an unkown error has occured.' +
	    			'Please contact the website\'s Administrator');
	    		alert(data);
	    	}
	    });
	});
	$(document).on('click', '#got-it', function(e) { 
		location.reload();
	});

</script>
@endsection
