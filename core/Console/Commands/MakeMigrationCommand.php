<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class MakeMigrationCommand extends Command
{
    protected function configure()
    {
        $this->name = 'make:migration';
        $this->description = 'Create a new migration';
    }
    
    public function handle($arguments = [])
    {
        if (empty($arguments[0])) {
            $this->writeln('Error: Migration name is required.');
            $this->writeln('Usage: php artisan make:migration create_table_name');
            return;
        }
        
        $migrationName = $arguments[0];
        $timestamp = date('YmdHis');
        $fileName = $timestamp . '_' . $migrationName . '.php';
        $filePath = __DIR__ . '/../../../database/migrations/' . $fileName;
        
        if (file_exists($filePath)) {
            $this->writeln("Error: Migration {$fileName} already exists.");
            return;
        }
        
        $stub = "<?php\nreturn [\n    'up' => function(\$capsule) {\n        // Create table\n    },\n    \n    'down' => function(\$capsule) {\n        // Drop table\n    }\n];\n";
        
        if (file_put_contents($filePath, $stub)) {
            $this->writeln("Migration {$fileName} created successfully at: {$filePath}");
        } else {
            $this->writeln("Error: Could not create migration file.");
        }
    }
}