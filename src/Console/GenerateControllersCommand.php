<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Console\Controllers\ImageControllerMakeCommand;
use Aqamarine\AlphaNews\Console\Controllers\MediaFolderControllerMakeCommand;
use Aqamarine\AlphaNews\Console\Controllers\PostCategoryControllerMakeCommand;
use Aqamarine\AlphaNews\Console\Controllers\PostControllerMakeCommand;
use Aqamarine\AlphaNews\Console\Controllers\PostTagControllerMakeCommand;
use Aqamarine\AlphaNews\Console\Controllers\PublishPostControllerMakeCommand;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateControllersCommand extends Command
{
    protected $name = 'alphanews:generate-controllers';

    protected $description = 'Generates all needed controllers.';

    public function handle(): int
    {
        $module = $this->argument('module');
        $this->call(ImageControllerMakeCommand::class, ['module' => $module]);
        $this->call(MediaFolderControllerMakeCommand::class, ['module' => $module]);
        $this->call(
            PostCategoryControllerMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );
        $this->call(
            PostControllerMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );
        $this->call(
            PostTagControllerMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );
        $this->call(
            PublishPostControllerMakeCommand::class,
            ['module' => $module, '--translations' => $this->option('translations')]
        );
        return 0;
    }

    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    public function getOptions(): array
    {
        return [
            ['translations', 't', InputOption::VALUE_NONE, 'Generate translations.'],
        ];
    }
}
