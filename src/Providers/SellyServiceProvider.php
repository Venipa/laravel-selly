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
    public function register($configPath = null): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom($configPath ?: __DIR__ . '/../../config/config.php', 'selly');

        // Register the classes to use with the facade
        $this->app->bind('selly', 'McCaulay\Selly\Selly');
    }
}
