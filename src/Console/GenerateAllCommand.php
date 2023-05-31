<?php

namespace Aqamarine\AlphaNews\Console;

use Symfony\Component\Console\Input\InputArgument;

class GenerateAllCommand extends \Illuminate\Console\Command
{
    protected $name = 'alphanews:generate-all';

    protected $description = 'Generates all needed files.';

    public function handle(): int
    {
        $module = $this->argument('module');
        $this->call(GenerateControllersCommand::class, ['module' => $module]);
        $this->call(GenerateViewsCommand::class, ['module' => $module]);
        $this->call(GenerateEnumsCommand::class);
        $this->call(GenerateRoutesCommand::class, ['module' => $module]);
        $this->call(GenerateModelsCommand::class, ['module' => $module]);
        return 0;
    }

    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
}
