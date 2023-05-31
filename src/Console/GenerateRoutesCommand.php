<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Support\Stub;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;

class GenerateRoutesCommand extends \Nwidart\Modules\Commands\GeneratorCommand
{
    use ModuleCommandTrait;

    protected $name = 'alphanews:generate-routes';

    protected $description = 'Generates all needed routes.';

    protected $argumentName = 'module';

    protected function getTemplateContents(): bool|array|string
    {
        return (new Stub($this->getStubName(), [
            'CONTROLLERS_NAMESPACE' => $this->getControllersNamespace(),
        ]))->render();
    }

    protected function getDestinationFilePath(): string
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $routesPath = GenerateConfigReader::read('routes');

        return $path . $routesPath->getPath() . '/posts.php';
    }

    public function getStubName(): string
    {
        return '/routes.stub';
    }

    public function getControllersNamespace(): string
    {
        $path = $this->laravel['modules']->config('paths.generator.controller.path', 'Http/Controllers');
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
}
