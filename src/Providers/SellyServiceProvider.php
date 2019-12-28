<?php
namespace McCaulay\Selly\Providers;

use Illuminate\Support\ServiceProvider;

class SellyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('selly.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register($config = []): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'selly');
        // Set/Update Initial Config
        $this->app->get('config')->selly($config);
        // Register the classes to use with the facade
        $this->app->bind('selly', 'McCaulay\Selly\Selly');
    }
}
