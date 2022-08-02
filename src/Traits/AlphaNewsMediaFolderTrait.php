<?php

namespace Aqamarine\AlphaNews\Traits;

trait AlphaNewsMediaFolderTrait
{

    public function initializeAlphaNewsMediaFolderTrait(): void
    {
        $this->fillable = array_merge($this->fillable, [
            'name', 'media_folder_id'
        ]);
    }

}
