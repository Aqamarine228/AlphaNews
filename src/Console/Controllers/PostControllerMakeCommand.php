<?php

namespace Aqamarine\AlphaNews\Console\Controllers;

use Aqamarine\AlphaNews\Support\ControllerGeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class PostControllerMakeCommand extends ControllerGeneratorCommand
{
    protected $name = 'alphanews:make-post-controller';

    protected $description = 'Creates Post Controller';

    protected function getControllerName(): string
    {
        return 'PostController';
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? '/post-translations-controller.stub'
            : '/post-controller.stub';
    }
}
