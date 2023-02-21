<?php

namespace DotZone\Dotzonestarters;

use DotZone\Dotzonestarters\Console\GeneratorCommand;
use Illuminate\Support\ServiceProvider;
use DotZone\Dotzonestarters\Console\InstallCommand;

class DotzonestartersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // load the helpers file
        require_once __DIR__ . '/DotzoneHelpers.php';
    }

        /**
     * Register the Invoices Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                GeneratorCommand::class,
            ]);
        }
    }
}
