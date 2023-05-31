<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostEditViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-edit-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post/edit';
    }

    protected function getStubName(): string
    {
        return '/views/post-edit-view.stub';
    }
}
