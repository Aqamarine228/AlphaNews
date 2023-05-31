<?php

namespace Aqamarine\AlphaNews\Console\Models;

use Aqamarine\AlphaNews\Support\ModelGeneratorCommand;

class ImageModelMakeCommand extends ModelGeneratorCommand
{

    protected $name = 'alphanews:make-image-model';

    protected $description = 'Creates Image Model';

    protected function getModelName(): string
    {
        return 'Image';
    }

    protected function getStubName(): string
    {
        return '/image-model.stub';
    }
}
