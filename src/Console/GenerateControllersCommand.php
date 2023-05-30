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

class GenerateControllersCommand extends Command
{
    protected $name = 'alphanews:generate-controllers';

    protected $description = 'Generates all needed controllers.';

    public function handle(): int
    {
        $module = $this->argument('module');
        $this->call(ImageControllerMakeCommand::class, ['module' => $module]);
        $this->call(MediaFolderControllerMakeCommand::class, ['module' => $module]);
        $this->call(PostCategoryControllerMakeCommand::class, ['module' => $module]);
        $this->call(PostControllerMakeCommand::class, ['module' => $module]);
        $this->call(PostTagControllerMakeCommand::class, ['module' => $module]);
        $this->call(PublishPostControllerMakeCommand::class, ['module' => $module]);
        return 0;
    }

    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
}
