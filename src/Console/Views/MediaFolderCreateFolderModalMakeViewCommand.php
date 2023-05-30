<?php

namespace Aqamarine\AlphaNews\Console\Views;

use Aqamarine\AlphaNews\Support\ViewGeneratorCommand;

class MediaFolderCreateFolderModalMakeViewCommand extends ViewGeneratorCommand
{
    protected $name = 'alphanews:make-media-folder-create-folder-modal-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'media-folder/_create-folder-modal';
    }

    protected function getStubName(): string
    {
        return '/views/media-folder-create-folder-modal-view.stub';
    }
}
