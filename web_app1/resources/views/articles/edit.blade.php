@extends('layouts.app')

@section('title', 'Edit an Article')

@section('content')
	<h1>Edit: {!! $article->title !!} </h1>

@include('errors.articleError')


	{!! Form::model($article, ['method' => 'PATCH','url' => 'articles/'. $article->id]) !!}
		@include('articles.form', ['submitButtonLabel' => 'Edit Article'])
	{!! Form::close() !!}

@stop