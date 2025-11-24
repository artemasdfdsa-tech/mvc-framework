<?php

namespace Core\Console;

abstract class Command
{
    protected $name;
    protected $description;
    
    public function __construct()
    {
        $this->configure();
    }
    
    abstract protected function configure();
    
    abstract public function handle($arguments = []);
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    protected function writeln($message)
    {
        echo $message . PHP_EOL;
    }
    
    protected function ask($question)
    {
        echo $question . ': ';
        return trim(fgets(STDIN));
    }
    
    protected function confirm($question)
    {
        echo $question . ' (y/n): ';
        $input = trim(fgets(STDIN));
        return strtolower($input) === 'y' || strtolower($input) === 'yes';
    }
}