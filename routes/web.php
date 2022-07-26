<?php

use Aqamarine\AlphaNews\Http\Controllers\AdminPanelController;
use Aqamarine\AlphaNews\Http\Controllers\PostCategoriesController;
use Aqamarine\AlphaNews\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminPanelController::class, 'dashboard'])->name('dashboard');

Route::prefix('/tags')->name('tags.')->group(function () {
    Route::get('/', [TagsController::class, 'index'])->name('index');
    Route::post('/', [TagsController::class, 'store'])->name('store');
    Route::get('/create', [TagsController::class, 'create'])->name('create');
    Route::delete('/{id}', [TagsController::class, 'destroy'])->name('destroy');
});

Route::prefix('/post-categories')->name('post-categories.')->group(function () {
    Route::get('/create', [PostCategoriesController::class, 'create'])->name('create');
    Route::post('/', [PostCategoriesController::class, 'store'])->name('store');
    Route::get('/{id?}', [PostCategoriesController::class, 'index'])->name('index');
    Route::prefix('/{id}')->group(function () {
        Route::get('/edit', [PostCategoriesController::class, 'edit'])->name('edit');
        Route::put('/', [PostCategoriesController::class, 'update'])->name('update');
        Route::delete('/', [PostCategoriesController::class, 'destroy'])->name('destroy');
    });
});
