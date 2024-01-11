<?php

namespace Aqamarine\AlphaNews\Console\Views;

class MediaFolderPreviewMakeViewCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-media-folder-preview-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'media-folder/_preview';
    }

    protected function getStubName(): string
    {
        return '/views/media-folder-preview-view.stub';
    }
}
