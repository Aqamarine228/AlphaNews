<?php

namespace Aqamarine\AlphaNews\Console\Migrations;

use Aqamarine\AlphaNews\Support\MigrationGeneratorCommand;

class PostCategoryLanguageMigrationMakeCommand extends MigrationGeneratorCommand
{
    protected $name = 'alphanews:make-post-category-language-migration';

    protected $description = 'Creates Post Category Language Migration';


    protected function getTableName(): string
    {
        return "post_category_language";
    }

    protected function getStubName(): string
    {
        return "/post-category-language-migration.stub";
    }
}
