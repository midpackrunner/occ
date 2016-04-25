<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Request;
use App\Http\Requests\CreateArticleRequest;
use Illuminate\Support\Facades\Auth;
class ArticlesController extends Controller {

	/**
	 * Returns all articles within the publish_at value
	 *
	 */
	public function index() {
		// using scope in the model
		$articles = Article::latest('published_at')->published()->get();

		return view('articles.index')->with('articles', $articles);
	}

	public function show($id) {

		$article = Article::findOrFail($id);
		$article->body = nl2br($article->body);
		// to debug -> dd($article)   , then return $article
		return view('articles.show')->with('article', $article);
	}

	public function create() {

		// to debug -> dd($article)   , then return $article
		return view('articles.create');
	}

	/**
	 * See app/Requests/CreateArticleRequest for validation
	 *
	 */
	public function store(CreateArticleRequest $request) {

		// validation: requires: title, body, and published_at

		// see Article class on how to control what can be passed
		$article = new Article($request->all());
		Auth::user()->articles()->save($article);

		return redirect('articles');
	}

	public function edit($id) {

		$article = Article::findOrFail($id);
		return view('articles.edit')->with('article', $article);
	}

	public function update($id, CreateArticleRequest $request) {

		$article = Article::findOrFail($id);

		$article->update($request->all());

		return redirect('articles');
	}

}
