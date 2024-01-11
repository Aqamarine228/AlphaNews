<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostStatusViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-status-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_status';
    }

    protected function getStubName(): string
    {
        return '/views/post-status-view.stub';
    }
}
