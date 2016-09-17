@extends('layouts.app')

@section('title', 'FAQs')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
	<div class="page-header">
		<h1 class="text-primary">Frequently Asked Questions </h1>
	</div>
</div>
<div class="spacer-sm"></div>
<div class="row">
	<div class="col-md-10">
		@foreach ($faqs as $faq)
		<dl>
			<dt class="text-primary">{{$faq->question}}</dt>
			<dd>{!!$faq->answer!!}</dd>
		</dl>
		@if(!Auth::guest() && Auth::user()->isAdmin())
		<a class="btn btn-warning btn-sm" href="{{ route('faqs.edit', $faq->id) }}" role="button">Edit</a>
		<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{$faq->id}}">
			Delete
		</button>				
		<div class="spacer-sm"></div>					
		<!-- Modal -->
		<div class="modal fade" id="delete-{{$faq->id}}">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Warning</h4>
					</div>
					<div class="modal-body">
						<p class="test-warning">Are you sure you want to delete this FAQ?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-sm jq-postback"  href="{{ route('faqs.destroy', $faq->id) }}" data-method="delete" role="button">Delete</a>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		@endif
		@endforeach
	</div>
</div>



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
	    		alert('Question and Answer have been removed');
	    		location.reload(); 
	    	}
	    	else {
	    		alert('Unknown Error: an unkown error has occured.' +
	    			'Please contact the website\'s Administrator');
	    		alert(data);
	    	}
	    });
	});

</script>
@endsection
