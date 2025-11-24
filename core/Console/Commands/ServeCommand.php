<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class ServeCommand extends Command
{
    protected function configure()
    {
        $this->name = 'serve';
        $this->description = 'Start the development server';
    }
    
    public function handle($arguments = [])
    {
        $host = env('APP_URL', 'localhost');
        $port = env("APP_PORT", 8080);
        
        foreach ($arguments as $arg) {
            if (str_starts_with($arg, '--host=')) {
                $host = substr($arg, 7);
            } elseif (str_starts_with($arg, '--port=')) {
                $port = substr($arg, 7);
            }
        }
        
        $this->writeln("Starting development server on http://{$host}:{$port}");
        $this->writeln("Press Ctrl+C to stop the server");
        
        $command = "php -S {$host}:{$port} -t public/";
        system($command);
    }
}