<?php

use Aqamarine\AlphaNews\Http\Controllers\AdminPanelController;
use Aqamarine\AlphaNews\Http\Controllers\PostCategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminPanelController::class, 'dashboard'])->name('dashboard');

Route::prefix('/post-categories')->name('post-categories.')->group(function () {
    Route::get('/create', [PostCategoriesController::class, 'create'])->name('create');
    Route::post('/', [PostCategoriesController::class, 'store'])->name('store');
    Route::get('/{id?}', [PostCategoriesController::class, 'index'])->name('index');
    Route::prefix('/{id}')->group(static function () {
        Route::get('/edit', [PostCategoriesController::class, 'edit'])->name('edit');
        Route::put('/', [PostCategoriesController::class, 'update'])->name('update');
        Route::delete('/', [PostCategoriesController::class, 'destroy'])->name('destroy');
    });
});
