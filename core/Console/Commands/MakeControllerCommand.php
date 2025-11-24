<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class MakeControllerCommand extends Command
{
    protected function configure()
    {
        $this->name = 'make:controller';
        $this->description = 'Create a new controller';
    }
    
    public function handle($arguments = [])
    {
        if (empty($arguments[0])) {
            $this->writeln('Error: Controller name is required.');
            $this->writeln('Usage: php artisan make:controller ControllerName');
            return;
        }
        
        $controllerName = $arguments[0];
        $controllerName = ucfirst($controllerName);
        
        if (!str_ends_with($controllerName, 'Controller')) {
            $controllerName .= 'Controller';
        }
        
        $filePath = __DIR__ . '/../../../app/controllers/' . $controllerName . '.php';
        
        if (file_exists($filePath)) {
            $this->writeln("Error: Controller {$controllerName} already exists.");
            return;
        }
        
        $stub = "<?php\n\nclass {$controllerName}\n{\n    public function index()\n    {\n        // Add your logic here\n    }\n}\n";
        
        if (file_put_contents($filePath, $stub)) {
            $this->writeln("Controller {$controllerName} created successfully at: {$filePath}");
        } else {
            $this->writeln("Error: Could not create controller file.");
        }
    }
}