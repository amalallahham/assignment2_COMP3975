<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

require __DIR__ . '/auth.php';

// Home redirect based on role
Route::middleware(['auth', 'verified'])->get('/', function () {
    $user = Auth::user();

    // Redirect to admin or contributor dashboard
    return $user->role === 'Admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
});

// Contributor dashboard
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Admin-only routes
Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/users/{id}/promote', [AdminController::class, 'promote'])->name('admin.promote');
});

// Profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
