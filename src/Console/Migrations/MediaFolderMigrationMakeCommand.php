<?php

namespace Aqamarine\AlphaNews\Console\Migrations;

use Aqamarine\AlphaNews\Support\MigrationGeneratorCommand;

class MediaFolderMigrationMakeCommand extends MigrationGeneratorCommand
{

    protected $name = 'alphanews:make-media-folder-migration';

    protected $description = 'Creates Media Folder Migration';

    protected function getTableName(): string
    {
        return "media_folders";
    }

    protected function getStubName(): string
    {
        return "/media-folder-migration.stub";
    }
}
