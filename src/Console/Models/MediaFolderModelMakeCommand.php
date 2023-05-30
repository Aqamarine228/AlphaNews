<?php

namespace Aqamarine\AlphaNews\Console\Models;

use Aqamarine\AlphaNews\Support\ModelGeneratorCommand;

class MediaFolderModelMakeCommand extends ModelGeneratorCommand
{

    protected $name = 'alphanews:make-media-folder-model';

    protected $description = 'Creates Media Folder Model';

    protected function getModelName(): string
    {
        return 'MediaFolder';
    }

    protected function getStubName(): string
    {
        return '/media-folder-model.stub';
    }
}
