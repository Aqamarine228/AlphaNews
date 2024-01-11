<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostTagIndexMakeViewCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-index-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-tag/index';
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? '/views/post-tag-translations-index-view.stub'
            : '/views/post-tag-index-view.stub';
    }
}
