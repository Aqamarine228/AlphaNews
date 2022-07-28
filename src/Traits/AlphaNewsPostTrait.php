<?php

namespace Aqamarine\AlphaNews\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

trait AlphaNewsPostTrait
{
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
            Config::get('alphanews.foreign_keys.tag'),
            Config::get('alphanews.foreign_keys.post')
        );
    }

    public function isPublished(): bool
    {
        return null !== $this->published_at;
    }

    public function isStep1Completed(): bool
    {
        return (bool) $this->post_category_id;
    }

    public function isStep2Completed(): bool
    {
        return (bool) $this->title;
    }

    public function isStep3Completed(): bool
    {
        return (bool) $this->short_title;
    }

    public function isStep4Completed(): bool
    {
        return (bool) $this->picture;
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
        return Storage::url(config('alphanews.posts.filesystem.original_images_path') . $this->picture);
    }

    public function previewImage(): string
    {
        return Storage::url(config('alphanews.posts.filesystem.preview_images_path') . $this->picture);
    }
}
