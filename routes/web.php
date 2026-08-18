<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\SummarizedIncidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {

    Route::middleware('role:user')->group(function () {
        Route::get('incidents/create', [IncidentController::class, 'create'])
            ->name('incidents.create');

        Route::post('incidents', [IncidentController::class, 'store'])
            ->name('incidents.store');
    });

    Route::resource('incidents', IncidentController::class)
        ->except(['create', 'store']);

    // Reviewer/admin status update
    Route::patch('incidents/{incident}/status', [IncidentController::class, 'updateStatus'])
        ->name('incidents.updateStatus');

});
Route::middleware(['auth', 'role:admin,reviewer'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/reviewers/create', [ReviewerController::class, 'create'])
        ->name('reviewers.create');

    Route::post('/reviewers', [ReviewerController::class, 'store'])
        ->name('reviewers.store');
});
//Route::resource('proofs', ProofController::class);
//Route::resource('summarizedIncidents', SummarizedIncidentController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
