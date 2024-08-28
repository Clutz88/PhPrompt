<?php

declare(strict_types=1);

namespace Phprompt\Commands;

use Exception;
use Phprompt\App;
use Phprompt\Contracts\Command;

class CommandFactory
{
    private string $namespace = 'Phprompt\\Commands\\';

    /**
     * @throws Exception
     */
    public function __invoke(string $class_name, App $app): Command
    {
        $full_class_name = $this->getFullClassName($class_name);
        if (! class_exists($full_class_name)) {
            throw new Exception("Class {$full_class_name} does not exist");
        }
        $command = new $full_class_name($app);

        if (! $command instanceof Command) {
            throw new Exception("Class {$full_class_name} must implement: " . Command::class);
        }

        return $command;
    }

    private function getFullClassName(string $class_name): string
    {
        $class_name = match ($class_name) {
            'echo' => 'print',
            default => $class_name
        };
        $class_name = ucfirst($class_name);

        return $this->namespace . $class_name . 'Command';
    }
}
