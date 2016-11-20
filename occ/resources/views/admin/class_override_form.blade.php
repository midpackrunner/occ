@extends('admin.admin_toolbar')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="container">
	<div class="page-header">
		<h1>Class Override</h1>
	</div>
@include('info_pop_ups.info_flash')
	<div class="row">
		<div class="col-md-3 col-md-offset-9">
			{!! link_to(url('/admin'), 'Back to Admin Main', ['class' => 'btn btn-primary btn-sm']) !!}
		</div>
	</div>

	<div class="spacer-sm"></div>

	<div class="row">
		<input type="hidden" class="form-control"  id="selected-usr_prf">
		<div class="col-md-9 col-md-offset-1">
			<label for="lname_search">1. Search for a Member</label>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search by Name" id="lname_search">
				<span class="input-group-btn">
					<button class="btn btn-secondary btn-primary" type="button"
					onclick="showStep2()">Go!</button>
				</span>
			</div>
		</div>
	</div>
	<div class="spacer-sm"></div>
	<div class="ovrd-form" hidden>
		{!! Form::open(['url' => 'class_override_form', 'class' => 'form-horizontal', 'id' => 'ovrd-form']) !!}
		<div class="row" id="step-2" >
			<div class="col-md-5 col-md-offset-1" id="verify-block">
				<label for="pet-select">2.  Select the Dog to Apply the Override to.</label>
				<div class="input-group">
					{!! Form::select('pet_id', [], null,['class' => 'form-control', 'id' => 'pet-select']) !!}
				</div>
			</div>
		</div>

		<div class="row" id="step-3">
			<div class="col-md-9 col-md-offset-1">
				<label for="class-select">3.  Select the Class the Override will apply to.</label>
				<div class="input-group">
					{!! Form::select('class_details_id', $class_array, null,['class' => 'form-control', 'id' => 'class-select']) !!}
				</div>

			</div>
		</div>
		<div class="spacer-sm"></div>
		<div class="form-group">
		<div class="col-md-4 col-md-offset-1">
				{!! Form::submit('Submit Override', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var usr_prf = <?php echo json_encode($usr_prf); ?>;
		var auto_cmp_up_search = [];
		usr_prf.forEach(function(usr) {
			auto_cmp_up_search.push(
				{label : usr['last_name'] + ', ' + usr['first_name'],
				value : usr['id']}
				);
		});
		
		$( "#lname_search" ).autocomplete({
			source: auto_cmp_up_search,
			select: function(event, ui) {
				event.preventDefault();
				$("#lname_search").val(ui.item.label);
				$("#selected-usr_prf").val(ui.item.value);
			},
			focus: function(event, ui) {
				event.preventDefault();
				$("#lname_search").val(ui.item.label);
			}
		});

		$( '#lname_search').change(function(){
			$('#pet-select').find('option').remove();
			if($("#lname_search").val() == '') {
				$("#selected-usr_prf").val(0);
			} else {
				$("#selected-usr_prf").val(ui.item.value);
			}
		});
	});

	function showStep2() {
		var usr_prf_id = $('#selected-usr_prf').val();
		if (usr_prf_id != 0 && usr_prf_id != null) {
			$('.ovrd-form').show();
		} else {
			$('.ovrd-form').hide();
		}
		var usr = {usr_prf_id : $('#selected-usr_prf').val()}
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		$.ajax({
			type: 'POST',
			url: '/ajax_get_pets',
			data: usr,
			dataType: 'JSON',
			success: function (data) {
				console.log(data);
				populatePetDropDown(data);
			},
			error: function (data) {
				console.log('Error:', data.responseText);
			}
		});
	}

	function populatePetDropDown(pets) {
		var $select = $('#pet-select'); 
		$select.find('option').remove();  
		$.each(pets,function(key, value) 
		{
			$select.append('<option value=' + key + '>' + value + '</option>');
		});
	}
</script>
@endsection