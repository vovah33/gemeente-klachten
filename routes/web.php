<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\MapController as AdminMapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Stable landing page after auth
    Route::get('/dashboard', function () {
        return redirect('/my/complaints');
    })->name('dashboard');

    // User complaints
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/my/complaints', [ComplaintController::class, 'myIndex'])->name('complaints.mine');
    Route::get('/my/complaints/{complaint}', [ComplaintController::class, 'showMine'])->name('complaints.show.mine');
});

// Admin routes
Route::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [AdminComplaintController::class, 'show'])->name('complaints.show');
    Route::patch('/complaints/{complaint}/resolve', [AdminComplaintController::class, 'resolve'])->name('complaints.resolve');
    Route::delete('/complaints/{complaint}', [AdminComplaintController::class, 'destroy'])->name('complaints.destroy');

    Route::get('/map', [AdminMapController::class, 'index'])->name('map.index');
    Route::get('/api/complaints', [AdminMapController::class, 'data'])->name('api.complaints');
});

require __DIR__.'/auth.php';
