<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostTagsViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-tags-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/blocks/_tags';
    }

    protected function getStubName(): string
    {
        return '/views/post-tags-view.stub';
    }
}
