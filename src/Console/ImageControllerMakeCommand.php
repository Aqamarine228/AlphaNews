<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Support\ControllerGeneratorCommand;

class ImageControllerMakeCommand extends ControllerGeneratorCommand
{
    protected $name = 'alphanews:make-image-controller';

    protected $description = 'Creates Image Controller';

    protected function getStubName(): string
    {
        return '/image-controller.stub';
    }

    protected function getControllerName(): string
    {
        return 'ImageController';
    }

    protected function getStubArguments(): array
    {
        return [
            'MODELS_NAMESPACE' => $this->getModelsNamespace(),
        ];
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
}
