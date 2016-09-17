@extends('admin.admin_toolbar')


@section('content')
<h2>Edit FAQ </h2>
<div class="row">
	<div class="col-md-12">
		{!! Form::model($faq, ['method' => 'PATCH','url' => 'faqs/'. $faq->id, 'class' => 'form-horizontal']) !!}
		@include('faqs.form', ['submitButtonLabel' => 'Edit FAQ'])
		{!! Form::close() !!}
	</div>
</div>
@stop