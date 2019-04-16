<?php

namespace DocMeUp\Connector\Bitbucket\App\Providers;

use DocMeUp\Connector\Bitbucket\Registrar;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->loadConfigDefaults();
    }
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/gitconnector.template.php' => config_path('gitconnector.php'),
       ], Registrar::PUBLISH_CONFIG_TAG);
    }

    /**
     * Load our config template by default. Let users override only the values they wish to.
     * @see https://laravel.com/docs/5.8/packages
     */
    private function loadConfigDefaults(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/gitconnector.template.php', 'gitconnector'
        );
    }
}
