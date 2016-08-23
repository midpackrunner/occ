@extends('layouts.app')

@section('title', 'Create an Article')

@section('content')
	<h1>Write a new Article</h1>

@include('errors.articleError')
	<p id="returned_json"></p>

	{!! Form::open(['url' => 'articles']) !!}
		@include('articles.form', ['submitButtonLabel' => 'Create Article'])
	{!! Form::close() !!}

@endsection