<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostImageViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-image-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_image';
    }

    protected function getStubName(): string
    {
        return '/views/post-image-view.stub';
    }
}
