<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostCategoryTranslationsFormViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-translations-form-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-category/_translations-form';
    }

    protected function getStubName(): string
    {
        return '/views/post-category-language-form-view.stub';
    }
}
