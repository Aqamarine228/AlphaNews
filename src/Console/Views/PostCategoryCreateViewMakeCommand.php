<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCategoryCreateViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-create-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-category/create';
    }

    protected function getStubName(): string
    {
        return '/views/post-category-create-view.stub';
    }
}
