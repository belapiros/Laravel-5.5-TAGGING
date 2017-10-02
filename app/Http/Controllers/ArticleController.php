<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
    	$articles = Article::all();
    	return view('article', compact('articles'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'body' => 'required',
    		'tags' => 'required'
    	]);

    	$input = $request->all();
    	$tags = explode(",", $request->tags);

    	$article = Article::create($input);
    	$article->tag($tags);

    	return back()->with('success', 'Article created successfully');
    }
}
