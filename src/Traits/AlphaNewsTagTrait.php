<?php

namespace Aqamarine\AlphaNews\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;

trait AlphaNewsTagTrait
{
    public function initializeAlphaNewsTagTrait(): void
    {
        $this->fillable = array_merge($this->fillable, [
            'name', 'posts_amount'
        ]);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Config::get('alphanews.models.post'),
        );
    }
}
