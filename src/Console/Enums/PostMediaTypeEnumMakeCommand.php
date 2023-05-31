<?php

namespace Aqamarine\AlphaNews\Console\Enums;

use Aqamarine\AlphaNews\Support\Stub;
use Illuminate\Support\Facades\File;

class PostMediaTypeEnumMakeCommand extends \Nwidart\Modules\Commands\GeneratorCommand
{
    protected $name = 'alphanews:make-post-media-type-enum';

    protected $description = 'Creates Post Media Type Enum';

    protected function getTemplateContents(): bool|array|string
    {
        return (new Stub($this->getStubName()))->render();
    }

    protected function getDestinationFilePath(): string
    {
        return base_path() . '/app/Enums/PostMediaType.php';
    }

    private function getStubName(): string
    {
        return '/post-media-type-enum.stub';
    }
}
