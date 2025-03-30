<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Article routes
Route::get('/articles', [ArticleController::class, 'index']);
// Route::post('/articles', [ArticleController::class, 'store']);
// Route::get('/articles/{id}', [ArticleController::class, 'show']);
// Route::put('/articles/{id}', [ArticleController::class, 'update']);
// Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

