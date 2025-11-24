<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class MakeModelCommand extends Command
{
    protected function configure()
    {
        $this->name = 'make:model';
        $this->description = 'Create a new model';
    }
    
    public function handle($arguments = [])
    {
        if (empty($arguments[0])) {
            $this->writeln('Error: Model name is required.');
            $this->writeln('Usage: php artisan make:model ModelName');
            return;
        }
        
        $modelName = $arguments[0];
        $modelName = ucfirst($modelName);
        
        $filePath = __DIR__ . '/../../../app/models/' . $modelName . '.php';
        
        if (file_exists($filePath)) {
            $this->writeln("Error: Model {$modelName} already exists.");
            return;
        }
        
        $stub = "<?php\n\nnamespace App\Models;\n\nuse Core\Model;\n\nclass {$modelName} extends Model\n{\n    protected \$table = '" . strtolower($modelName) . "';\n    \n    // Define fillable fields\n    protected \$fillable = [];\n}\n";
        
        if (file_put_contents($filePath, $stub)) {
            $this->writeln("Model {$modelName} created successfully at: {$filePath}");
        } else {
            $this->writeln("Error: Could not create model file.");
        }
    }
}