<?php

namespace Aqamarine\AlphaNews\Console\Models;

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
        return $this->option('translations') ? '/post-category-translations-model.stub' : '/post-category-model.stub';
    }
}
