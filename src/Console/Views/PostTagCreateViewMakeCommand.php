<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostTagCreateViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-create-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-tag/create';
    }

    protected function getStubName(): string
    {
        return '/views/post-tag-create-view.stub';
    }
}
