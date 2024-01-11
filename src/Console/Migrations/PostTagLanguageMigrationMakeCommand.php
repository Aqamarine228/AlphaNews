<?php

namespace Aqamarine\AlphaNews\Console\Migrations;


use Aqamarine\AlphaNews\Support\MigrationGeneratorCommand;

class PostTagLanguageMigrationMakeCommand extends MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-post-tag-language-migration';

    protected $description = 'Creates Post Tag Language Migration';

    protected function getTableName(): string
    {
        return "post_tag_language";
    }

    protected function getStubName(): string
    {
        return "/post-tag-language-migration.stub";
    }
}
