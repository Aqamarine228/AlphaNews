<?php

namespace Aqamarine\AlphaNews\Console\Views;

use Aqamarine\AlphaNews\Support\ViewGeneratorCommand;

class MediaFolderUploadImageModalMakeViewCommand extends ViewGeneratorCommand
{
    protected $name = 'alphanews:make-media-folder-upload-image-modal-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'media-folder/_upload-image-modal';
    }

    protected function getStubName(): string
    {
        return '/views/media-folder-upload-image-modal-view.stub';
    }
}
