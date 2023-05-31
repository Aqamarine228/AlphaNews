<?php

namespace Aqamarine\AlphaNews\Console\Models;

use Aqamarine\AlphaNews\Support\ModelGeneratorCommand;

class PostTagModelMakeCommand extends ModelGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-model';

    protected $description = 'Creates Post Tag Model';

    protected function getModelName(): string
    {
        return 'PostTag';
    }

    protected function getStubName(): string
    {
        return '/post-tag-model.stub';
    }
}
