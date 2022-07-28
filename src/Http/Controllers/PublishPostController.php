<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class PublishPostController extends AlphaNewsController
{
    public mixed $postModel;

    public function __construct()
    {
        $this->postModel = Config::get('alphanews.models.post');
    }

    /**
     * @throws Throwable
     * @throws ValidationException
     */
    public function publish(int $id): RedirectResponse
    {
        $post = $this->postModel::findOrFail($id);
        if ($post->isPublished()) {
            $this->showErrorMessage('Post is already published');
            return back();
        }
        if (!$post->publishable()) {
            $this->showErrorMessage("Post is not publishable because:");
            $post->isStep1Completed() ?: $this->showErrorMessage("Parent category is not selected");
            $post->isStep2Completed() ?: $this->showErrorMessage("Post has no title");
            $post->isStep3Completed() ?: $this->showErrorMessage("Post has no short title");
            $post->isStep4Completed() ?: $this->showErrorMessage("Post has no picture");
            return back();
        }

        $validated = $this->validate(request(), [
            'date' => [
                'date_format:Y-m-d',
                'before_or_equal:' . date('Y-m-d'),
                'required'
            ]
        ]);

        DB::transaction(static function () use ($post, $validated) {
            $post->update([
                'published_at' => $validated['date']
            ]);
            $post->category()->increment('posts_amount');
            $post->tags()->increment('posts_amount');
        });

        $this->showSuccessMessage('Post published successfully');
        return back();
    }

    /**
     * @throws Throwable
     */
    public function unPublish(int $id): RedirectResponse
    {
        $post = $this->postModel::findOrFail($id);
        if (!$post->isPublished()) {
            $this->showErrorMessage('Cannot un publish not published post');
            return back();
        }

        DB::transaction(static function () use ($post) {
            $post->update([
                'published_at' => null
            ]);
            $post->category()->decrement('posts_amount');
            $post->tags()->decrement('posts_amount');
        });

        $this->showSuccessMessage('Post unpublished successfully');
        return back();
    }
}
