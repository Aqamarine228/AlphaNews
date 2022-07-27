<?php

use Aqamarine\AlphaNews\Http\Controllers\AdminPanelController;
use Aqamarine\AlphaNews\Http\Controllers\ImagesController;
use Aqamarine\AlphaNews\Http\Controllers\MediaFoldersController;
use Aqamarine\AlphaNews\Http\Controllers\PostCategoriesController;
use Aqamarine\AlphaNews\Http\Controllers\PostsController;
use Aqamarine\AlphaNews\Http\Controllers\PublishPostController;
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

Route::prefix('/media-folders')->name('media-folders.')->group(function () {
    Route::post('/', [MediaFoldersController::class, 'store'])->name('store');
    Route::get('/{id?}', [MediaFoldersController::class, 'index'])->name('index');
    Route::prefix('/images')->name('images.')->group(function () {
        Route::post('/tinymce', [ImagesController::class, 'storeFromTinymce'])->name('store-from-tinymce');
        Route::post('/', [ImagesController::class, 'store'])->name('store');
    });
});

Route::prefix('/posts')->name('posts.')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('index');
    Route::get('/all', [PostsController::class, 'indexAllPosts'])->name('all');
    Route::post('/', [PostsController::class, 'store'])->name('store');
    Route::prefix('/{id}')->group(function () {
        Route::get('/edit', [PostsController::class, 'edit'])->name('edit');
        Route::put('/content', [PostsController::class, 'updateContent'])->name('update.content');
        Route::put('/preview', [PostsController::class, 'updatePreview'])->name('update.preview');
        Route::put('/category', [PostsController::class, 'updateCategory'])->name('update.category');
        Route::put('/media-type', [PostsController::class, 'updateMediaType'])->name('update.media-type');
        Route::put('/date-ico', [PostsController::class, 'updateDateIco'])->name('update.date-ico');
        Route::put('/tags', [PostsController::class, 'updateTags'])->name('update.tags');
        Route::put('/image', [PostsController::class, 'updateImage'])->name('update.image');
        Route::put('/main', [PostsController::class, 'mainPost'])->name('update.main');

        Route::post('/publish', [PublishPostController::class, 'publish'])->name('publish');
        Route::post('/unpublish', [PublishPostController::class, 'unPublish'])->name('unpublish');
    });
});
