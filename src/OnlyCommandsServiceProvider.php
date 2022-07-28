<?php

namespace Aqamarine\AlphaNews;

use Aqamarine\AlphaNews\Console\CreateAlphaNewsModuleCommand;

class OnlyCommandsServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot(): void
    {
        $this->registerCommands();
    }

    /**
     * Register the AlphaNews commands.
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateAlphaNewsModuleCommand::class
            ]);
        }
    }

}
