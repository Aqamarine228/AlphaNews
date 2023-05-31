<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCategoryIndexViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-index-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-category/index';
    }

    protected function getStubName(): string
    {
        return '/views/post-category-index-view.stub';
    }
}
