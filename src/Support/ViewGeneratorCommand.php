<?php

namespace Aqamarine\AlphaNews\Support;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

abstract class ViewGeneratorCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'module';

    abstract protected function getViewName(): string;

    abstract protected function getStubName(): string;

    protected function getTemplateContents(): bool|array|string
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'MODULE_LOWER' => $module->getLowerName(),
            'MODELS_NAMESPACE' => $this->getModelsNamespace(),
        ]))->render();
    }

    protected function getDestinationFilePath(): string
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $controllerPath = GenerateConfigReader::read('views');

        return $path . $controllerPath->getPath() . '/' . $this->getViewName() . '.blade.php';
    }

    private function getModelsNamespace(): string
    {
        $path = $this->laravel['modules']->config('paths.generator.model.path', 'Models');
        $path = str_replace('/', '\\', $path);

        return $this->laravel['modules']->config('namespace')
            . '\\'
            . $this->laravel['modules']->findOrFail($this->getModuleName())
            . '\\'
            . $path;
    }

    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['translations', 't', InputOption::VALUE_NONE, 'Creates translation files'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the controller already exists'],
        ];
    }

}
