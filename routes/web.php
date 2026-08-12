<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\SummarizedIncidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('categories', CategoryController::class);
Route::resource('incidents', IncidentController::class);
Route::resource('proofs', ProofController::class);
Route::resource('summarizedIncidents', SummarizedIncidentController::class);
