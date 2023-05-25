<?php

namespace Aqamarine\AlphaNews\Console;

class TagControllerMakeCommand extends \Aqamarine\AlphaNews\Support\ControllerGeneratorCommand
{
    protected $name = 'alphanews:make-tag-controller';

    protected $description = 'Creates Tag Controller';

    protected function getControllerName(): string
    {
        return 'TagController';
    }

    protected function getStubName(): string
    {
        return '/tag-controller.stub';
    }
}
