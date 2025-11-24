<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class MakeViewCommand extends Command
{
    protected function configure()
    {
        $this->name = 'make:view';
        $this->description = 'Create a new view file';
    }
    
    public function handle($arguments = [])
    {
        if (empty($arguments[0])) {
            $this->writeln('Error: View name is required.');
            $this->writeln('Usage: php artisan make:view view.name');
            return;
        }
        
        $viewName = $arguments[0];
        $filePath = __DIR__ . '/../../../app/views/' . str_replace('.', '/', $viewName) . '.blade.php';
        
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        if (file_exists($filePath)) {
            $this->writeln("Error: View {$viewName} already exists.");
            return;
        }
        
        $stub = "<!-- View for {$viewName} -->\n<h1>" . ucfirst(str_replace('.', ' ', $viewName)) . "</h1>\n\n";
        
        if (file_put_contents($filePath, $stub)) {
            $this->writeln("View {$viewName} created successfully at: {$filePath}");
        } else {
            $this->writeln("Error: Could not create view file.");
        }
    }
}