<?php

namespace Aqamarine\AlphaNews\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

trait AlphaNewsImageTrait
{
    public function getFullUrl(): string
    {
        return Storage::disk(Config::get('alphanews.media.filesystem.disk'))
            ->url(config('alphanews.media.filesystem.images_path') . '/' . $this->name);
    }
}
