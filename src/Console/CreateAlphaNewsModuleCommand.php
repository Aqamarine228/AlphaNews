<?php

namespace Aqamarine\AlphaNews\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Commands\ModuleMakeCommand;

class CreateAlphaNewsModuleCommand extends Command
{

    protected $name = 'alphanews:create-module';

    protected $description = 'Create AlphaNews Module';

    public function handle(): void
    {
        $this->call('module:make', [
            'name' => ['AlphaNews']
        ]);
        $this->moveConfig();
        $this->moveRoutes();
        $this->moveAssets();
        $this->moveViews();
    }

    private function moveConfig(): void
    {
        File::copy(__DIR__ . '/../../config/alphanews.php', base_path() . '/Modules/AlphaNews/Config/config.php');
    }

    private function moveRoutes(): void
    {
        File::copy(__DIR__ . '/../../routes/web.php', base_path() . '/Modules/AlphaNews/Routes/web.php');
    }

    private function moveAssets(): void
    {
        File::copyDirectory(__DIR__ . '/../../public', public_path('/vendor/alphanews'));
    }

    private function moveViews(): void
    {
        File::copyDirectory(__DIR__ . '/../../resources/views', base_path() . '/Modules/AlphaNews/Resources/views');
    }
}
