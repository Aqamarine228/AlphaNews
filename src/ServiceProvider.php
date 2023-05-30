<?php

namespace Aqamarine\AlphaNews;

use Aqamarine\AlphaNews\Console\GenerateAllCommand;
use Aqamarine\AlphaNews\Console\GenerateControllersCommand;
use Aqamarine\AlphaNews\Console\GenerateEnumsCommand;
use Aqamarine\AlphaNews\Console\GenerateModelsCommand;
use Aqamarine\AlphaNews\Console\GenerateRoutesCommand;
use Aqamarine\AlphaNews\Console\GenerateViewsCommand;
use Aqamarine\AlphaNews\Console\Views\MediaFolderCreateFolderModalMakeViewCommand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as ParentProvider;

class ServiceProvider extends ParentProvider
{
    public function boot(): void
    {
        Paginator::useBootstrap();
        $this->registerRoutes();
        $this->registerResources();
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
     * Register the routes used by the AlphaNews admin panel.
     */
    protected function registerRoutes(): void
    {
        Route::group([
            'namespace' => 'AlphaNews\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register all the possible views used by AlphaNews.
     */
    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'alphanews');
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
            __DIR__ . '/../public' => public_path('vendor/alphanews'),
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
