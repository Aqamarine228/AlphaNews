<?php

namespace Aqamarine\AlphaNews\Console\Controllers;

class PostTagControllerMakeCommand extends \Aqamarine\AlphaNews\Support\ControllerGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-controller';

    protected $description = 'Creates Tag Controller';

    protected function getControllerName(): string
    {
        return 'PostTagController';
    }

    protected function getStubName(): string
    {
        return '/post-tag-controller.stub';
    }
}
