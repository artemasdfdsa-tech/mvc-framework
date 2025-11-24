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
        $this->commands = [
            new Commands\ListCommand(),
            new Commands\ServeCommand(),
            new Commands\MakeControllerCommand(),
            new Commands\MakeModelCommand(),
            new Commands\MigrateCommand(),
            new Commands\MakeMigrationCommand(),
            new Commands\MakeViewCommand(),
        ];
    }

    public function addCommand(Command $command)
    {
        $this->commands[] = $command;
    }

    public function getCommands()
    {
        return $this->commands;
    }

    public function handle($input, $output)
    {
        $commandName = $input[1] ?? null;
        
        if ($commandName === 'list' || $commandName === null) {
            $this->listCommands($output);
            return;
        }

        $command = $this->findCommand($commandName);
        if ($command) {
            $arguments = array_slice($input, 2);
            $command->handle($arguments);
        } else {
            $output->writeln("Command '$commandName' not found. Use 'php artisan list' to see available commands.");
        }
    }

    protected function findCommand($name)
    {
        foreach ($this->commands as $command) {
            if ($command->getName() === $name) {
                return $command;
            }
        }
        return null;
    }

    protected function listCommands($output)
    {
        $output->writeln("Available commands:");
        foreach ($this->commands as $command) {
            $output->writeln(sprintf(" %s    - %s", str_pad($command->getName(), 15), $command->getDescription()));
        }
    }
}