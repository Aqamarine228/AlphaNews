<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostMediaTypeViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-media-type-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_media-type';
    }

    protected function getStubName(): string
    {
        return '/views/post-media-type-view.stub';
    }
}
