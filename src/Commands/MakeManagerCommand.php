<?php

namespace Neokofg\ClmCli\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeManagerCommand extends Command
{
    protected $signature = 'make:manager {name} {--model=}';
    protected $description = 'Creates new manager';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $modelName = $this->option('model') ?? $name;
        $modulePath = base_path("App/Modules/{$modelName}/Managers/");

        if (File::exists($modulePath)) {
            $this->error("Manager {$name} already exists!");
            return;
        }

        File::makeDirectory($modulePath, 0755, true);

        $managerTemplate = file_get_contents(__DIR__ . '/stubs/manager.stub');
        $managerTemplate = str_replace('{{name}}', $name, $managerTemplate);
        $managerTemplate = str_replace('{{model}}', $modelName, $managerTemplate);
        file_put_contents("{$modulePath}/{$name}Manager.php", $managerTemplate);

        $this->info("Manager {$name} successfully created.");
    }
}
