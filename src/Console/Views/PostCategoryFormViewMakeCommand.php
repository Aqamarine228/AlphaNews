<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCategoryFormViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-form-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-category/_form';
    }

    protected function getStubName(): string
    {
        return '/views/post-category-form-view.stub';
    }
}
