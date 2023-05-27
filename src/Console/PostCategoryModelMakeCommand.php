<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Support\ModelGeneratorCommand;

class PostCategoryModelMakeCommand extends ModelGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-model';

    protected $description = 'Creates Post Category Model';

    protected function getModelName(): string
    {
        return 'PostCategory';
    }

    protected function getStubName(): string
    {
        return '/post-category-model.stub';
    }
}
