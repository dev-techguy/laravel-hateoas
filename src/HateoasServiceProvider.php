<?php

namespace GDebrauwer\Hateoas;

use Illuminate\Support\ServiceProvider;
use GDebrauwer\Hateoas\Formatters\Formatter;
use GDebrauwer\Hateoas\Commands\HateoasMakeCommand;
use GDebrauwer\Hateoas\Formatters\DefaultFormatter;

class HateoasServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                HateoasMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('hateoas', function () {
            return $this->app->make(HateoasManager::class);
        });

        $this->app->bind(Formatter::class, DefaultFormatter::class);
    }
}
