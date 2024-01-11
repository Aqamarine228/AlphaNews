<?php

namespace Aqamarine\AlphaNews\Console\Migrations;


use Aqamarine\AlphaNews\Support\MigrationGeneratorCommand;

class PostTagMigrationMakeCommand extends MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-migration';

    protected $description = 'Creates Post Tag Migration';

    protected function getTableName(): string
    {
        return "post_tags";
    }

    protected function getStubName(): string
    {
        return $this->option('translations') ? "/post-tag-translations-migration.stub" : "/post-tag-migration.stub";
    }
}
