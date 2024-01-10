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
        $this->registerMigrationsPublishing();
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
                LanguageModelMakeCommand::class,
                PostTagModelMakeCommand::class,
                GenerateAllCommand::class,
                GenerateControllersCommand::class,
                GenerateModelsCommand::class,
                GenerateRoutesCommand::class,
                GenerateEnumsCommand::class,
                GenerateMigrationsCommand::class,
                GenerateViewsCommand::class,
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
     * Register the AlphaNews migrations publishing.
     */
    protected function registerMigrationsPublishing(): void
    {
        if (config('alphanews.register_migrations', true)) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'alphanews-migrations');
        }
    }

    /**
     * Set up the configuration for AlphaNews.
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/alphanews.php', 'alphanews');
    }
}
