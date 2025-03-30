<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function __construct()
    {
        // Apply auth middleware only to create, edit, update, and delete methods
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $now = Carbon::now();

        // Get all articles
        $articles = Article::all()->map(function ($article) use ($now) {
            // Add an "is_expired" flag to each article
            $article->is_expired = $article->end_date < $now;
            return $article;
        });

        $articles = $articles->sortBy([
            fn($a, $b) => ($a->is_expired <=> $b->is_expired),
            fn($a, $b) => $b->create_date <=> $a->create_date,
        ])->values();


        return view('articles.index', compact('articles'));
    }


    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $article = new Article($validated);
        $article->contributor_username = Auth::user()->username;
        $article->create_date = now();
        $article->save();

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        $now = Carbon::now();
        $isActive = $article->start_date <= $now && $article->end_date >= $now;
        $isOwner = Auth::check() && (
            Auth::user()->role === 'Admin' ||
            Auth::user()->username === $article->contributor_username
        );

        // Only allow viewing if article is active or if user is admin/owner
        if (!$isActive && !$isOwner) {
            abort(404, 'Article not available.');
        }

        return view('articles.show', compact('article', 'isActive'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
