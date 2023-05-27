<?php

namespace Aqamarine\AlphaNews;

use Aqamarine\AlphaNews\Console\CreateAlphaNewsModuleCommand;
use Aqamarine\AlphaNews\Console\ImageControllerMakeCommand;
use Aqamarine\AlphaNews\Console\ImageModelMakeCommand;
use Aqamarine\AlphaNews\Console\MediaFolderControllerMakeCommand;
use Aqamarine\AlphaNews\Console\MediaFolderModelMakeCommand;
use Aqamarine\AlphaNews\Console\PostCategoryControllerMakeCommand;
use Aqamarine\AlphaNews\Console\PostCategoryModelMakeCommand;
use Aqamarine\AlphaNews\Console\PostControllerMakeCommand;
use Aqamarine\AlphaNews\Console\PostModelMakeCommand;
use Aqamarine\AlphaNews\Console\PostTagModelMakeCommand;
use Aqamarine\AlphaNews\Console\PublishPostControllerMakeCommand;
use Aqamarine\AlphaNews\Console\TagControllerMakeCommand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as ParentProvider;
use League\Flysystem\Config;

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
                CreateAlphaNewsModuleCommand::class,
                ImageControllerMakeCommand::class,
                MediaFolderControllerMakeCommand::class,
                PostCategoryControllerMakeCommand::class,
                PostControllerMakeCommand::class,
                PublishPostControllerMakeCommand::class,
                TagControllerMakeCommand::class,
                ImageModelMakeCommand::class,
                MediaFolderModelMakeCommand::class,
                PostModelMakeCommand::class,
                PostCategoryModelMakeCommand::class,
                PostTagModelMakeCommand::class,
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
