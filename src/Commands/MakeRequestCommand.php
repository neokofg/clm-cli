<?php

namespace Neokofg\ClmCli\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRequestCommand extends Command
{
    protected $signature = 'make:clm-request {name} {--model=}';
    protected $description = 'Creates new request';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $modelName = $this->option('model') ?? $name;
        $modulePath = base_path("App/Modules/{$modelName}/Requests/");

        if (File::exists($modulePath.$name.'Request.php')) {
            $this->error("Request {$name} already exists!");
            return;
        }

        File::makeDirectory($modulePath, 0755, true, true);

        $requestTemplate = file_get_contents(__DIR__ . '/stubs/request.stub');
        $requestTemplate = str_replace('{{name}}', $name, $requestTemplate);
        $requestTemplate = str_replace('{{model}}', $modelName, $requestTemplate);
        file_put_contents("{$modulePath}/{$name}Request.php", $requestTemplate);

        $this->info("Request {$name} successfully created.");
    }
}