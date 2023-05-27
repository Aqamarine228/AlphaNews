<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Support\ModelGeneratorCommand;

class PostModelMakeCommand extends ModelGeneratorCommand
{
    protected $name = 'alphanews:make-post-model';

    protected $description = 'Creates Post Model';

    protected function getModelName(): string
    {
        return 'Post';
    }

    protected function getStubName(): string
    {
        return '/post-model.stub';
    }
}
