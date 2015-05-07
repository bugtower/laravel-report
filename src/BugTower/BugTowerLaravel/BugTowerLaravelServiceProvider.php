<?php namespace BugTower\BugTowerLaravel;

use Illuminate\Support\ServiceProvider;

class BugTowerLaravelServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        $app = $this->app;

        if (version_compare($app::VERSION, '5.0') < 0) {

            $this->package('BugTower/BugTower-laravel', 'BugTower');

            // Register for exception handling
            $app->error(function (\Exception $exception) use ($app) {
                if ('Symfony\Component\Debug\Exception\FatalErrorException'
                    !== get_class($exception)
                ) {
                    $app['BugTower']->notifyException($exception, null, "error");
                }
            });

            // Register for fatal error handling
            $app->fatal(function ($exception) use ($app) {
                $app['BugTower']->notifyException($exception, null, "error");
            });
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('BugTower', function ($app) {
            $config = isset($app['config']['services']['BugTower']) ? $app['config']['services']['BugTower'] : null;
            if (is_null($config)) {
                $config = $app['config']['BugTower'] ?: $app['config']['BugTower::config'];
            }
            
            return new \BugTower\BugTowerLaravel\BugTowerClient();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array("BugTower");
    }
}
