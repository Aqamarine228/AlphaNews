<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostAddToTopViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-add-top-top-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_add-to-top';
    }

    protected function getStubName(): string
    {
        return '/views/post-add-to-top-view.stub';
    }
}
