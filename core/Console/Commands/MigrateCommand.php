<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class MigrateCommand extends Command
{
    protected function configure()
    {
        $this->name = 'migrate';
        $this->description = 'Run database migrations';
    }
    
    public function handle($arguments = [])
    {
        $this->writeln('Running database migrations...');
        
        $migrateFile = __DIR__ . '/../../../database/migrate-artisan.php';
        if (file_exists($migrateFile)) {
            $cmd = 'php ' . escapeshellarg($migrateFile);
            foreach ($arguments as $arg) {
                $cmd .= ' ' . escapeshellarg($arg);
            }
            
            system($cmd);
        } else {
            $this->writeln('Error: Migration file not found.');
        }
    }
}