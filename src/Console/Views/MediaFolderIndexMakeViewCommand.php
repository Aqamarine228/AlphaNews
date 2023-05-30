<?php

namespace Aqamarine\AlphaNews\Console\Views;

use Aqamarine\AlphaNews\Support\ViewGeneratorCommand;

class MediaFolderIndexMakeViewCommand extends ViewGeneratorCommand
{
    protected $name = 'alphanews:make-media-folder-index-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'media-folder/index';
    }

    protected function getStubName(): string
    {
        return '/views/media-folder-index-view.stub';
    }
}
