<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostActionsViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-actions-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_actions';
    }

    protected function getStubName(): string
    {
        return '/views/post-actions-view.stub';
    }
}
