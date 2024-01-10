<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Console\Migrations\ImageMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\MediaFolderMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostCategoryLanguageMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostCategoryMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostLanguageMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostPostTagMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostTagLanguageMigrationMakeCommand;
use Aqamarine\AlphaNews\Console\Migrations\PostTagMigrationMakeCommand;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class GenerateMigrationsCommand extends Command
{

    protected $name = 'alphanews:generate-migrations';

    protected $description = 'Creates all needed migrations.';

    public function handle(): int
    {
        $this->call(PostCategoryMigrationMakeCommand::class, [
            '--translations' => $this->option('translations'),
        ]);
        $this->call(PostMigrationMakeCommand::class, [
            '--translations' => $this->option('translations'),
        ]);
        $this->call(PostTagMigrationMakeCommand::class, [
            '--translations' => $this->option('translations'),
        ]);

        $this->call(MediaFolderMigrationMakeCommand::class);

        sleep(1);

        if ($this->option('translations')) {
            $this->call(PostCategoryLanguageMigrationMakeCommand::class);
            $this->call(PostLanguageMigrationMakeCommand::class);
            $this->call(PostTagLanguageMigrationMakeCommand::class);
            sleep(1);
        }

        $this->call(PostPostTagMigrationMakeCommand::class);
        $this->call(ImageMigrationMakeCommand::class);

        return 0;
    }

    public function getOptions(): array
    {
        return [
            ['translations', 't', InputOption::VALUE_NONE, 'Generate translations.'],
        ];
    }

}
