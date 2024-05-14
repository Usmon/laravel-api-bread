<?php

namespace Usmon\Microcore\Providers;

use Illuminate\Support\ServiceProvider;

class CommandsServiceProvider extends ServiceProvider {
    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \Usmon\Microcore\Commands\MakeControllerApi::class,
            \Usmon\Microcore\Commands\MakeRepositoryApi::class,
            \Usmon\Microcore\Commands\MakeRequestApi::class,
            \Usmon\Microcore\Commands\Bread::class,
        ]);
    }
}
