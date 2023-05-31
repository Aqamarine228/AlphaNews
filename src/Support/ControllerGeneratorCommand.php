<?php

namespace Aqamarine\AlphaNews\Support;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

abstract class ControllerGeneratorCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'module';

    abstract protected function getControllerName(): string;

    abstract protected function getStubName(): string;

    protected function getTemplateContents(): bool|array|string
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'MODULE_NAME' => $module->getLowerName(),
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'MODULE' => $this->getModuleName(),
            'BASE_CONTROLLER' => $this->getBaseControllerPath($module->getStudlyName()),
            'MODELS_NAMESPACE' => $this->getModelsNamespace(),
        ]))->render();
    }

    protected function getDestinationFilePath(): string
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $controllerPath = GenerateConfigReader::read('controller');

        return $path . $controllerPath->getPath() . '/' . $this->getControllerName() . '.php';
    }

    public function getDefaultNamespace(): string
    {
        $module = $this->laravel['modules'];

        return $module->config('paths.generator.controller.namespace')
            ?: $module->config('paths.generator.controller.path', 'Http/Controllers');
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

    public function getBaseControllerPath(string $module): string
    {
        if ($this->option('base')) {
            return $this->option('base');
        }

        $path = $this->laravel['modules']->config('paths.generator.controller.path', 'Http/Controllers');
        $path = str_replace('/', '\\', $path);

        return $this->laravel['modules']->config('namespace')
            . '\\'
            . $this->laravel['modules']->findOrFail($this->getModuleName())
            . '\\'
            . $path
            . '\\'
            . 'Base'
            . $module
            . 'Controller';
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
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the controller already exists'],
            ['base', 'b', InputOption::VALUE_OPTIONAL, 'Namespace of class which will current class extend.'],
        ];
    }
}
