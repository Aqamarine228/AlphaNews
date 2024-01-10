<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCategoryEditViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-edit-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-category/edit';
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? '/views/post-category-translations-edit-view.stub'
            : '/views/post-category-edit-view.stub';
    }
}
