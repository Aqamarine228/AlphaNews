<?php

namespace Aqamarine\AlphaNews;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as ParentProvider;

class ServiceProvider extends ParentProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
        $this->registerResources();
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
        if (!$this->app['config']->get('alphanews.panel.register')) {
            return;
        }

        Route::group([
            'prefix' => config('alphanews.panel.path', 'alphanews'),
            'namespace' => 'AlphaNews\Http\Controllers',
            'middleware' => config('alphanews.panel.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register all the possible views used by AlphaNews.
     */
    protected function registerResources(): void
    {
        if (!$this->app['config']->get('alphanews.panel.register')) {
            return;
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alphanews');
    }

    /**
     * Register the AlphaNews config publishing.
     */
    protected function registerConfigPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/alphanews.php' => config_path('alphanews.php'),
        ], 'alphanews-config');
    }

    /**
     * Register the assets that are publishable for the admin panel to work.
     */
    protected function registerAssetPublishing(): void
    {
        if (!$this->app['config']->get('alphanews.panel.register')) {
            return;
        }

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/alphanews'),
        ], 'alphanews-assets');
    }

    /**
     * Set up the configuration for AlphaNews.
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/alphanews.php', 'alphanews');
    }
}
