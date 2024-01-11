<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostPublishViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-publish-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_publish';
    }

    protected function getStubName(): string
    {
        return '/views/post-publish-view.stub';
    }
}
