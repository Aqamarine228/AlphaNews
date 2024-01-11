<?php

namespace Aqamarine\AlphaNews\Support;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputOption;

abstract class MigrationGeneratorCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'module';

    abstract protected function getTableName(): string;

    abstract protected function getStubName(): string;

    protected function getTemplateContents(): bool|array|string
    {
        return (new Stub($this->getStubName()))->render();
    }

    protected function getDestinationFilePath(): string
    {
        return $this->laravel->databasePath().'/migrations/'.$this->getFileName().'.php';
    }

    private function getFileName(): string
    {
        return date('Y_m_d_His_') . 'create_' . $this->getTableName() . '_table';
    }

    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the request already exists'],
            ['translations', 't', InputOption::VALUE_NONE, 'Will use translated version on migration.'],
        ];
    }

}
