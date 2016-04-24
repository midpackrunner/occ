@extends('layout.master')

@section('title', 'Article Details')


@section('content')
	<h1>Article Details</h1>

	<article>
		<div class="panel panel-default">
		<div class="panel-heading">{{ $article->title }}</div>
		<div class="panel-body"> {{ $article->body }}</div>
		</div>
	</article>

@endsection