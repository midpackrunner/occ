<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Request;
use App\Http\Requests\CreateArticleRequest;
use Illuminate\Support\Facades\Auth;
class ArticlesController extends Controller {

	
	public function __construct() {
		$this->middleware('auth', ['only' => 'create']);
		$this->middleware('demo', ['only' => 'create']);

	}

	/**
	 * Returns all articles within the publish_at value
	 *
	 */
	public function index() {
		// using scope in the model
		$articles = Article::latest('published_at')->published()->get();

		return view('articles.index')->with('articles', $articles);
	}

	/**
	 * See RouteServiceProvider->boot for model binding.  Without binding
	 * you would need to have show($id), however, using binding, the $id key
	 * is replaced with the object itself.  This means, within this function
	 * you do not have to query the DB manually with:
	 * 
	 * 					$article = Article::findOrFail($id);
	 */
	public function show(Article $article) {

			$article->body = nl2br($article->body);
			// to debug -> dd($article)   , then return $article
			return view('articles.show')->with('article', $article);
	}

	public function create() {

		// to debug -> dd($article)   , then return $article
        /* if (Auth::guest()) {     //<- One way to go about it, but redundant
			return redirect('articles');  //<- See constructor for middleware
		}*/
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

	public function edit(Article $article) {

		return view('articles.edit')->with('article', $article);
	}

	public function update($id, CreateArticleRequest $request) {

		$article = Article::findOrFail($id);

		$article->update($request->all());

		return redirect('articles');
	}

}
