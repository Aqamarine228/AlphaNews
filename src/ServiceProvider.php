<?php

namespace Aqamarine\AlphaNews;

use Aqamarine\AlphaNews\Console\GenerateAllCommand;
use Aqamarine\AlphaNews\Console\GenerateControllersCommand;
use Aqamarine\AlphaNews\Console\GenerateEnumsCommand;
use Aqamarine\AlphaNews\Console\GenerateMigrationsCommand;
use Aqamarine\AlphaNews\Console\GenerateModelsCommand;
use Aqamarine\AlphaNews\Console\GenerateRoutesCommand;
use Aqamarine\AlphaNews\Console\GenerateViewsCommand;
use Aqamarine\AlphaNews\Console\Models\LanguageModelMakeCommand;
use Aqamarine\AlphaNews\Console\Models\PostTagModelMakeCommand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider as ParentProvider;

class ServiceProvider extends ParentProvider
{
    public function boot(): void
    {
        Paginator::useBootstrap();
        $this->registerCommands();
        $this->registerAssetPublishing();
        $this->registerConfigPublishing();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->configure();
    }

    /**
     * Register the AlphaNews commands.
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateAllCommand::class,
            ]);
        }
    }

    /**
     * Register the AlphaNews config publishing.
     */
    protected function registerConfigPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../config/alphanews.php' => config_path('alphanews.php'),
        ], 'alphanews-config');
    }

    /**
     * Register the assets that are publishable for the admin panel to work.
     */
    protected function registerAssetPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../public' => public_path(),
        ], 'alphanews-assets');
    }

    /**
     * Set up the configuration for AlphaNews.
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/alphanews.php', 'alphanews');
    }
}
