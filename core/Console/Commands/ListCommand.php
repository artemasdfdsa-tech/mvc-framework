<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class ListCommand extends Command
{
    protected function configure()
    {
        $this->name = 'list';
        $this->description = 'Show this help message';
    }
    
    public function handle($arguments = [])
    {
        $this->writeln('Available commands:');
        $this->writeln(" list    - Show this help message");
        $this->writeln(" serve   - Start the development server");
    }
}