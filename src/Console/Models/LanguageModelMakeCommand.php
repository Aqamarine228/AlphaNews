<?php

namespace Aqamarine\AlphaNews\Console\Models;

use Aqamarine\AlphaNews\Support\ModelGeneratorCommand;

class LanguageModelMakeCommand extends ModelGeneratorCommand
{
    protected $name = 'alphanews:make-language-model';

    protected $description = 'Creates Language Model';

    protected function getModelName(): string
    {
        return 'Language';
    }

    protected function getStubName(): string
    {
        return '/language-model.stub';
    }

}
