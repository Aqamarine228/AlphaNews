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
        return $this->option('translations')
            ? '/views/post-category-translations-index-view.stub'
            : '/views/post-category-index-view.stub';
    }
}
