<?php

namespace Aqamarine\AlphaNews\Console\Controllers;

use Symfony\Component\Console\Input\InputOption;

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
        return $this->option('translations')
            ? '/post-tag-translations-controller.stub'
            : '/post-tag-controller.stub';
    }

}
