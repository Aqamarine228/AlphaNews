<?php

namespace Aqamarine\AlphaNews\Console\Views;

class PostTagTranslationsFormViewMakeCommand extends \Aqamarine\AlphaNews\Support\ViewGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-translations-form-view';

    protected $description = 'Generates given view.';

    protected function getViewName(): string
    {
        return 'post-tag/_translations-form';
    }

    protected function getStubName(): string
    {
        return '/views/post-tag-language-form-view.stub';
    }
}
