<?php

namespace Aqamarine\AlphaNews\Console\Migrations;


use Aqamarine\AlphaNews\Support\MigrationGeneratorCommand;

class PostCategoryMigrationMakeCommand extends MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-migration';

    protected $description = 'Creates Post Category Migration';

    protected function getTableName(): string
    {
        return "post_categories";
    }

    protected function getStubName(): string
    {
        return $this->option('translations')
            ? "/post-category-translations-migration.stub"
            : "/post-category-migration.stub";
    }
}
