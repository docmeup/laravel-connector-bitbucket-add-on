<?php

namespace DocMeUp\Connector\Bitbucket\App\Providers;

use DocMeUp\Connector\Bitbucket\Registrar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $middlewareGroups = [
        'connector' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */

    public function boot()
    {
        parent::boot();
        $this->registerPublishableFiles();
        $this->assignMiddlewareGroups();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        if($this->hasRoutesFile())
           $this->mapConnectorRoutes();
    }

    /**
     * Define the "connector" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapConnectorRoutes()
    {
        Route::prefix('connector')
            ->middleware('connector')
            ->namespace($this->namespace)
            ->group($this->getRoutesFilePath());
    }

    /**
     * @return string
     */
    protected function getRoutesFilePath(): string
    {
        return base_path('routes/connector.php');
    }

    protected function registerPublishableFiles(): void
    {
        $this->publishes([
            __DIR__ . '/../../routes/connector.template.php' => $this->getRoutesFilePath(),
        ], Registrar::PUBLISH_CONFIG_TAG);
    }

    protected function assignMiddlewareGroups(): void
    {
        foreach ($this->middlewareGroups as $name => $class) {
            $this->middlewareGroup($name, $class);
        }
    }

    /**
     * @return bool
     */
    protected function hasRoutesFile(): bool
    {
        return File::exists($this->getRoutesFilePath()) && File::isFile($this->getRoutesFilePath());
    }
}
