<?php

namespace Neokofg\ClmCli\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeManagerCommand extends Command
{
    protected $signature = 'make:manager {name} {--model=}';
    protected $description = 'Создает новый менеджер';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $modelName = $this->option('model') ?? $name;
        $modulePath = base_path("Modules/{$modelName}/{$name}");

        if (File::exists($modulePath)) {
            $this->error("Модуль {$name} уже существует!");
            return;
        }

        File::makeDirectory($modulePath, 0755, true);

        $managerTemplate = file_get_contents(__DIR__ . '/stubs/manager.stub');
        $managerTemplate = str_replace('{{name}}', $name, $managerTemplate);
        $managerTemplate = str_replace('{{model}}', $modelName, $managerTemplate);
        file_put_contents("{$modulePath}/{$modelName}/{$name}Manager.php", $managerTemplate);

        $this->info("Модуль {$name} успешно создан.");
    }
}