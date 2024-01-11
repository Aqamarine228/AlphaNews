<?php

namespace Aqamarine\AlphaNews\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateAllCommand extends \Illuminate\Console\Command
{
    protected $name = 'alphanews:generate-all';

    protected $description = 'Generates all needed files.';

    public function handle(): int
    {
        $module = $this->argument('module');
        $this->call(
            GenerateControllersCommand::class,
            ['module' => $module, '--translations' => !$this->option('no-translations')]
        );
        $this->call(
            GenerateViewsCommand::class,
            ['module' => $module, '--translations' => !$this->option('no-translations')]
        );
        $this->call(GenerateEnumsCommand::class);
        $this->call(
            GenerateRoutesCommand::class,
            ['module' => $module, '--translations' => !$this->option('no-translations')]
        );
        $this->call(
            GenerateModelsCommand::class,
            ['module' => $module, '--translations' => !$this->option('no-translations')]
        );
        $this->call(
            GenerateMigrationsCommand::class,
            ['--translations' => !$this->option('no-translations')]
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
            ['no-translations', 'nt', InputOption::VALUE_NONE, 'Wont generate translation files']
        ];
    }

}
