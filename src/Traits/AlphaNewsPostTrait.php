<?php

namespace Aqamarine\AlphaNews\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

trait AlphaNewsPostTrait
{

    public function initializeAlphaNewsPostTrait(): void
    {
        $this->fillable = array_merge($this->fillable, [
            'post_category_id', 'author_id', 'title', 'short_content', 'short_title', 'content', 'picture',
            'published_at', 'is_trending_now', 'views', 'media_type'
        ]);
        $this->dates = array_merge($this->dates, ['published_at']);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(
            Config::get('alphanews.models.user'),
            Config::get('alphanews.foreign_keys.user'),
            'id',
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Config::get('alphanews.models.post_category'),
            Config::get('alphanews.foreign_keys.post_category'),
            'id',
        );
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Config::get('alphanews.models.tag'),
            'post_tag',
            Config::get('alphanews.foreign_keys.post'),
            Config::get('alphanews.foreign_keys.tag'),
        );
    }

    public function isPublished(): bool
    {
        return null !== $this->published_at;
    }

    public function isStep1Completed(): bool
    {
        return (bool)$this->post_category_id;
    }

    public function isStep2Completed(): bool
    {
        return (bool)$this->title;
    }

    public function isStep3Completed(): bool
    {
        return (bool)$this->short_title;
    }

    public function isStep4Completed(): bool
    {
        return (bool)$this->picture;
    }

    public function publishable(): bool
    {
        return $this->isStep1Completed()
            && $this->isStep2Completed()
            && $this->isStep3Completed()
            && $this->isStep4Completed();
    }

    public function originalImage(): string
    {
        return Storage::disk(config('alphanews.posts.filesystem.disk'))
            ->url(config('alphanews.posts.filesystem.original_images_path') . '/' . $this->picture);
    }

    public function previewImage(): string
    {
        return Storage::disk(config('alphanews.posts.filesystem.disk'))
            ->url(config('alphanews.posts.filesystem.preview_images_path') . '/' . $this->picture);
    }
}
