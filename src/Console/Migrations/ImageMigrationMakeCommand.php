<?php

namespace Aqamarine\AlphaNews\Console\Migrations;

class ImageMigrationMakeCommand extends \Aqamarine\AlphaNews\Support\MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-image-migration';

    protected $description = 'Creates Image Migration';

    protected function getTableName(): string
    {
        return "images";
    }

    protected function getStubName(): string
    {
        return "/image-migration.stub";
    }
}
