<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostTagTranslationsEditViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-translations-edit-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-tag/edit';
    }

    protected function getStubName(): string
    {
        return '/views/post-tag-translations-edit-view.stub';
    }
}
