<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Support\ControllerGeneratorCommand;

class MediaFolderControllerMakeCommand extends ControllerGeneratorCommand
{
    protected $name = 'alphanews:make-media-folder-controller';

    protected $description = 'Creates Media Folder Controller';

    protected function getStubName(): string
    {
        return '/media-folder-controller.stub';
    }

    protected function getControllerName(): string
    {
        return 'MediaFolderController';
    }
}
