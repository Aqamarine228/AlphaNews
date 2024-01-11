<?php

namespace Aqamarine\AlphaNews\Console\Migrations;

class PostMigrationMakeCommand extends \Aqamarine\AlphaNews\Support\MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-post-migration';

    protected $description = 'Creates Post Migration';

    protected function getTableName(): string
    {
        return "posts";
    }

    protected function getStubName(): string
    {
        return $this->option('translations') ? '/post-translations-migration.stub' : '/post-migration.stub';
    }
}
