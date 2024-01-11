<?php

namespace Aqamarine\AlphaNews\Console\Migrations;

use Aqamarine\AlphaNews\Support\MigrationGeneratorCommand;

class PostPostTagMigrationMakeCommand extends MigrationGeneratorCommand
{

    protected $name = 'alphanews:make-post-post-tag-migration';

    protected $description = 'Creates Post Post Tag Migration';

    protected function getTableName(): string
    {
        return 'post_post_tag';
    }

    protected function getStubName(): string
    {
        return '/post-post-tag-migration.stub';
    }
}
