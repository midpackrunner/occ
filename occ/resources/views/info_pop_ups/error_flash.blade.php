@if (Session::has('error_message'))
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<div class="alert alert-danger"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('error_message')}}</div>
		</div>
	</div>
	<script type="text/javascript">
		$('div.alert').delay(7000).slideUp(500);
	</script>
	@endif