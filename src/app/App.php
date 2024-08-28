<?php

declare(strict_types=1);

namespace App;

use Laravel\Prompts\Key;
use Laravel\Prompts\Prompt;
use App\Commands\PrintCommand;
use App\Renderers\HomeRenderer;
use App\Commands\CommandFactory;
use Chewie\Input\KeyPressListener;
use Chewie\Concerns\RegistersRenderers;

class App extends Prompt
{
    use RegistersRenderers;

    public string $current_working_directory = '/home/php';
    public string $command = '';
    public string $result = '';
    public array $history = [];

    /*
     * Constructor
     */
    public function __construct()
    {
        $this->registerRenderer(HomeRenderer::class);

        KeyPressListener::for($this)
            ->on(Key::BACKSPACE, fn () => $this->command = mb_strlen($this->command) ? mb_substr($this->command, 0, -1) : '')
            ->on(Key::CTRL_C, fn () => $this->cancel())
            ->on(Key::CTRL_D, fn () => $this->terminal()->exit())
            ->on(Key::ENTER, fn () => $this->run())
            ->wildcard(fn ($key) => $this->command .= $key)
            ->listen();
    }

    protected function run(): void
    {
        $this->history[] = ['type' => 'command', 'output' => $this->command];
        $this->history[] = ['type' => 'result', 'output' => $this->runCommand()];
        $this->command = '';
    }

    private function runCommand(): string
    {
        $command = collect(explode(' ', $this->command));
        $cmd = $command->shift();
        $input = $command->implode(' ');

        try {
            $class = (new CommandFactory)((string) $cmd, $this);

            return $class->run($input);
        } catch (\Throwable $exception) {
            return $this->red('command not found: '.$cmd);
        }

        //        return match ($cmd) {
        //            'print', 'echo' => (new PrintCommand())->run($input),
        //            default => $this->red('command not found: '.$cmd),
        //        };
    }

    private function cancel(): void
    {
        $this->history[] = ['type' => 'command', 'output' => $this->command];
        $this->command = '';
    }

    /**
     * Get the value of the prompt.
     */
    public function value(): mixed
    {
        return null;
    }
}
