<?php

namespace Aqamarine\AlphaNews\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Config;

trait AlphaNewsPostCategoryTrait
{
    public function posts(): HasMany
    {
        return $this->hasMany(
            Config::get('alphanews.models.post'),
            Config::get('alphanews.foreign_keys.post_category'),
            'id'
        );
    }

    public function childCategories(): HasMany
    {
        return $this->hasMany(
            $this::class,
            Config::get('alphanews.foreign_keys.post_category'),
            'id'
        );
    }
}
