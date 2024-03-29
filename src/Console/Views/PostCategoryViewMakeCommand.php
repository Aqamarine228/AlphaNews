<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCategoryViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_category';
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? '/views/post-translations-category-view.stub'
            : '/views/post-category-view.stub';
    }
}
