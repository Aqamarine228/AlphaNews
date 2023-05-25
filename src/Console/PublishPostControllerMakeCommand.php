<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Support\ControllerGeneratorCommand;

class PublishPostControllerMakeCommand extends ControllerGeneratorCommand
{
    protected $name = 'alphanews:make-publish-post-controller';

    protected $description = 'Creates Publish Post Controller';

    protected function getControllerName(): string
    {
        return 'PublishPostController';
    }

    protected function getStubName(): string
    {
        return '/publish-post-controller.stub';
    }
}
