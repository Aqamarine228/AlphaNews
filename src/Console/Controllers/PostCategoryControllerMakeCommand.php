<?php

namespace Aqamarine\AlphaNews\Console\Controllers;

use Aqamarine\AlphaNews\Support\ControllerGeneratorCommand;

class PostCategoryControllerMakeCommand extends ControllerGeneratorCommand
{

    protected $name = 'alphanews:make-post-category-controller';

    protected $description = 'Creates Post Category Controller';

    protected function getControllerName(): string
    {
        return 'PostCategoryController';
    }

    protected function getStubName(): string
    {
        return '/post-category-controller.stub';
    }
}
