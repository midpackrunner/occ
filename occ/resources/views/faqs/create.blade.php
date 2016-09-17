@extends('admin.admin_toolbar')

@section('content')
<h2>Create a new FAQ</h2>
<div class="row">
	<div class="col-md-12">
		{!! Form::open(['url' => 'faqs', 'class' => 'form-horizontal']) !!}
		@include('faqs.form', ['submitButtonLabel' => 'Create FAQ'])
		{!! Form::close() !!}
	</div>
</div>
@endsection