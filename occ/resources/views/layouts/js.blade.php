  <!-- JavaScripts -->
  <script src="{{ asset('js/jQuery.1.12.3.min.js') }}"></script>
  <script src="{{ asset('js/tether.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui-1.10.0.custom.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-select-1.10.0/dist/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('js/masker.js') }}"></script>

<script type="text/javascript">
	$( document ).ready(function() {
	if ( $('[type="date"]').prop('type') != 'date' ) {
		$('[type="date"]').datepicker({dateFormat: 'yy-mm-dd'});
	}
	});	
</script>
