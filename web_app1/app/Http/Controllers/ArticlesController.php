<?php

namespace App\Http\Controllers;
use App\Article;

class ArticlesController extends Controller {

	public function index() {
		$articles = Article::all();

		return view('articles.index')->with('articles', $articles);
	}

	public function show($id) {

		$article = Article::findOrFail($id);

		// to debug -> dd($article)   , then return $article
		return view('articles.show')->with('article', $article);
	}

	public function create() {

		// to debug -> dd($article)   , then return $article
		return view('articles.create');
	}

}
