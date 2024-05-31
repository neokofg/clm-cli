<?php

namespace Neokofg\ClmCli;

use Illuminate\Support\ServiceProvider;
use Neokofg\ClmCli\Commands\MakeManagerCommand;
use Neokofg\ClmCli\Commands\MakeRequestCommand;

class ClmCliServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeManagerCommand::class,
            MakeRequestCommand::class
        ]);
    }

    public function boot()
    {
        //
    }
}