<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return view('public.articles.show', compact('article'));
    }

    public function index()
    {
        $articles = Article::with('author')->latest()->get();
        $authors = Author::all(); // 👈 Fetch authors from the database

        return view('admin.articles.index', compact('articles', 'authors'));
    }

    public function create()
    {
        $authors = Author::all(); // 👈 Fetch authors from the database
        return view('admin.articles.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);

        Article::create($request->all());

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $authors = Author::all();
        return view('admin.articles.edit', compact('article', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);

        $article->update($request->all());

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}
