<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostTagFormViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-form-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-tag/_form';
    }

    protected function getStubName(): string
    {
        return '/views/post-tag-form-view.stub';
    }
}
