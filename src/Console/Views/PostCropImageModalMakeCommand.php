<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCropImageModalMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-crop-image-modal-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_crop-image-modal';
    }

    protected function getStubName(): string
    {
        return '/views/post-crop-image-modal.stub';
    }
}
