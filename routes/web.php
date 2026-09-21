<?php

use App\Http\Controllers\KaroraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KaroraController::class, 'index']);

Route::get('/karora/{id}', [KaroraController::class, 'show']);