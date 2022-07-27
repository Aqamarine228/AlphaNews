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
        if ($post->isPublished() || !$post->publishable()) {
            abort(404);
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
            $post->tags()->increment('post_amount');
        });

        $this->showSuccessMessage('Post published successfully');
        return back();
        // add post to telegram channel
    }

    /**
     * @throws Throwable
     */
    public function unPublish(int $id): RedirectResponse
    {
        $post = $this->postModel::findOrFail($id);
        if (!$post->isPublished()) {
            abort(404);
        }

        DB::transaction(static function () use ($post) {
            $post->update([
                'published_at' => null
            ]);
            $post->category()->decrement('posts_amount');
            $post->tags()->decrement('post_amount');
        });

        $this->showSuccessMessage('Post unpublished successfully');
        return back();
    }
}
