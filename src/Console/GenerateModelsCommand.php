<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Console\Models\ImageModelMakeCommand;
use Aqamarine\AlphaNews\Console\Models\MediaFolderModelMakeCommand;
use Aqamarine\AlphaNews\Console\Models\PostCategoryModelMakeCommand;
use Aqamarine\AlphaNews\Console\Models\PostModelMakeCommand;
use Aqamarine\AlphaNews\Console\Models\PostTagModelMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class GenerateModelsCommand extends \Illuminate\Console\Command
{
    protected $name = 'alphanews:generate-models';

    protected $description = 'Generates all needed models.';

    public function handle(): int
    {
        $module = $this->argument('module');
        $this->call(ImageModelMakeCommand::class, ['module' => $module]);
        $this->call(MediaFolderModelMakeCommand::class, ['module' => $module]);
        $this->call(PostCategoryModelMakeCommand::class, ['module' => $module]);
        $this->call(PostModelMakeCommand::class, ['module' => $module]);
        $this->call(PostTagModelMakeCommand::class, ['module' => $module]);
        return 0;
    }

    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
}
