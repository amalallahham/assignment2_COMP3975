<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $articles = Article::where('end_date', '>=', $now)
            ->orderBy('start_date', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $articles
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'contributor_username' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'create_date' => now(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'contributor_username' => $request->contributor_username,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $article
        ], 201);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }

        // Check if article is currently valid
        $today = Carbon::today();
        if ($today->lt($article->start_date) || $today->gt($article->end_date)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article is not currently available'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'contributor_username' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $article->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }

        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Article deleted successfully'
        ]);
    }
}
