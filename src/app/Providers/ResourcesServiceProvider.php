<?php

namespace DocMeUp\Connector\Bitbucket\App\Providers;

use DocMeUp\Connector\Bitbucket\Registrar;
use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../resources/views/connector/bitbucket' => resource_path('views/connector/bitbucket'),
       ], Registrar::PUBLISH_CONFIG_TAG);
    }
}
