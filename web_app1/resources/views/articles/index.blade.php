@extends('layout.master')

@section('title', 'Articles')

@section('content')
	<h1>Articles</h1>

  @foreach ($articles as $article)
	<article>
		<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ action('ArticlesController@show', [$article->id]) }}"> {{ $article->title }}</a>
		</div>
		<div class="panel-body"> {{ $article->body }}</div>
		</div>
	</article>
	@endforeach

@stop