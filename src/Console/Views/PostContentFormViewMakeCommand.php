<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostContentFormViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-content-form-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_content-form';
    }

    protected function getStubName(): string
    {
        return '/views/post-content-form-view.stub';
    }
}
