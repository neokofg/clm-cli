<?php

namespace Neokofg\ClmCli;

use Illuminate\Support\ServiceProvider;
use Neokofg\ClmCli\Commands\MakeManagerCommand;

class ClmCliServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeManagerCommand::class,
        ]);
    }

    public function boot()
    {
        //
    }
}