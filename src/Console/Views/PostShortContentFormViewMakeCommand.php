<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostShortContentFormViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-short-content-form-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_short-content-form';
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? '/views/post-translations-short-content-form-view.stub'
            : '/views/post-short-content-form-view.stub';
    }
}
