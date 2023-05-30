<?php

use Aqamarine\AlphaNews\Http\Controllers\ImagesController;
use Aqamarine\AlphaNews\Http\Controllers\MediaFoldersController;
use Aqamarine\AlphaNews\Http\Controllers\PostCategoriesController;
use Aqamarine\AlphaNews\Http\Controllers\PostsController;
use Aqamarine\AlphaNews\Http\Controllers\PublishPostController;
use Aqamarine\AlphaNews\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:web'])
    ->group(function () {
        Route::resource('post-tag', PostTagController::class)->except('show', 'edit', 'update');

        Route::resource('post-category', PostCategoryController::class)->except('show');

        Route::prefix('/media-folder')->name('media-folders.')->group(function () {
            Route::post('/', [MediaFoldersController::class, 'store'])->name('store');
            Route::get('/{mediaFolder}', [MediaFoldersController::class, 'index'])->name('index');
            Route::prefix('/images')->name('image.')->group(function () {
                Route::post('/tinymce', [ImagesController::class, 'storeFromTinymce'])->name('store-from-tinymce');
                Route::post('/', [ImagesController::class, 'store'])->name('store');
            });
        });

        Route::resource('post', PostController::class)->except('show', 'update');

        Route::prefix('/post')->name('post.')->group(function () {
            Route::get('/all', [PostsController::class, 'indexAllPosts'])->name('all');
            Route::prefix('/{post}')->group(function () {
                Route::put('/content', [PostsController::class, 'updateContent'])->name('update.content');
                Route::put('/preview', [PostsController::class, 'updatePreview'])->name('update.preview');
                Route::put('/category', [PostsController::class, 'updateCategory'])->name('update.category');
                Route::put('/media-type', [PostsController::class, 'updateMediaType'])->name('update.media-type');
                Route::put('/tags', [PostsController::class, 'updateTags'])->name('update.tags');
                Route::put('/image', [PostsController::class, 'updateImage'])->name('update.image');
                Route::put('/main', [PostsController::class, 'mainPost'])->name('update.main');
                Route::post('/publish', [PublishPostController::class, 'publish'])->name('publish');
                Route::post('/unpublish', [PublishPostController::class, 'unPublish'])->name('unpublish');
            });
        });
    });
