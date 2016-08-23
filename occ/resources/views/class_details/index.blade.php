@extends('admin.admin_toolbar')

@section('title', 'Admin: Classes Offered')


@section('content')
@if (Session::has('message'))
<div class="row">
	<div class="col-md-4">
		<div class="alert alert-success">{{ Session::get('message') }}</div>
	</div>
</div>
@endif
@include('admin.admin_class_nav_bar')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#special-notes">
				<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Special Notes
			</button>
			<a class="btn btn-primary btn-sm pull-right" href="{{ route('class_details.create') }}" role="button">Add a New Class</a>
		</div>
	</div>
	<div class="spacer-md"></div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover table-responsive"> 

				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Description</th>
					<th>Cost</th>
					<th data-toggle="tooltip" data-placement="top" title="Age is in Months">Minimum Age</th>
					<th data-toggle="tooltip" data-placement="top" title="Age is in Months">Maximum Age</th>
					<th>Activated</th>
					<th></th>
				</tr>
				<tbody>
					@foreach($classes_details as $class_detail)
					<tr>
						<td>{{ $class_detail->id }}</td>
						<td>{{ $class_detail->title }}</td>
						<td>{{ substr($class_detail->description, 0, 30) . '...' }}</td>
						<td>{{ $class_detail->cost }}</td>
						<td>{{ $class_detail->minimum_age_requirement }}</td>
						<td class="pet-age">{{ $class_detail->maximum_age_requirement }}</td>
						<td>
							@if ($class_detail->is_active == 1)
							Yes
							@else
							No
							@endif
						</td>
						<td>
							<a class="btn btn-warning btn-sm" href="{{ route('class_details.edit', $class_detail->id) }}" role="button">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</table>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="special-notes">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">About Class Details</h4>
			</div>
			<div class="modal-body">
				<ul>
					<li><strong>ID:</strong> The ID is used for uploading the class schedule per session.
						If you have questions about uploading class schedules, please refer to the documentation
						or contact the Site Administrator.</li>
						<li>All Ages are in Months.</li>
						<li>If there is no maximum age restriction for a class, then supply <strong>99.99</strong> as the value</li>
						<li><strong>Activated Classes</strong> means that these classes can be viewed by our
							members.  If you deactivate a class, it will no longer be accessible nor can a class be offered in the class schedules.</li>
							<li><strong>Cost</strong> is the total cost of the class without any membership discount applied to it.  Membership types and discounts can be found in the <i>Members</i> page. </li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Got It!</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<script type="text/javascript">
			$('div.alert').delay(1400).slideUp();
		</script>
		@endsection
