<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;

// Public routes
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/lsls', [ArticleController::class, 'create'])->name('articles.create');

// Protected routes that require login and approval
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/articles/create/auth', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

});

// Admin-only routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/users/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/users/{id}/promote', [AdminController::class, 'promote'])->name('admin.promote');
});


// Approval pending route
Route::middleware(['auth'])->get('/approval-pending', function () {
    return view('auth.approval-pending');
})->name('approval.pending');

require __DIR__ . '/auth.php';
