<?php

namespace Core\Console;

use Illuminate\Container\Container;

class Kernel
{
    protected $container;
    protected $commands = [];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function registerCommands()
    {
        // Register default commands
        $this->commands = [
            // Add command classes here
        ];
    }

    public function handle($input, $output)
    {
        $command = $input[1] ?? null;
        
        if ($command === 'list') {
            $this->listCommands($output);
        } else {
            $output->writeln("Command '$command' not found. Use 'php artisan list' to see available commands.");
        }
    }

    protected function listCommands($output)
    {
        $output->writeln("Available commands:");
        $output->writeln(" list    - Show this help message");
        $output->writeln(" serve   - Start the development server");
    }
}