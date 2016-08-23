@if (Session::has('flash_message'))
<div class="row">
<div class="col-md-9 col-md-offset-1">
	<div class="alert alert-success"> 
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('flash_message')}}</div>
	</div>
</div>
	<script type="text/javascript">
		$('div.alert').delay(7000).slideUp(500);
	</script>
@endif