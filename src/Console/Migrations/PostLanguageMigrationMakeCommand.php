<?php

namespace Aqamarine\AlphaNews\Console\Migrations;

class PostLanguageMigrationMakeCommand extends \Aqamarine\AlphaNews\Support\MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-post-language-migration';

    protected $description = 'Creates Post Language Migration';

    protected function getTableName(): string
    {
        return "post_language";
    }

    protected function getStubName(): string
    {
        return "/post-language-migration.stub";
    }
}
