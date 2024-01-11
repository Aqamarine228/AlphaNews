<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostIndexViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-index-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/index';
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? '//views/post-translations-index-view.stub'
            : '/views/post-index-view.stub';
    }
}
