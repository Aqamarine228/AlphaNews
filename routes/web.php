<?php

use Aqamarine\AlphaNews\Http\Controllers\AdminPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminPanelController::class, 'dashboard'])->name('dashboard');
