<?php

declare(strict_types=1);

namespace App\Renderers;

use App\App;
use Chewie\Concerns\Aligns;
use Laravel\Prompts\Themes\Default\Renderer;

class HomeRenderer extends Renderer
{
    use Aligns;

    /**
     * Invoke
     */
    public function __invoke(App $app): static
    {
        collect($app->history)
            /** @phpstan-ignore-next-line */
            ->map(fn (array $line) => match ($line['type']) {
                'command' => $this->bold('$ ') . $line['output'],
                default => $line['output']
            })
            ->each($this->line(...));

        $this->line($this->bold('$ ') . $app->command);
        if ($app->result) {
            $this->line($app->result);
        }

        return $this;
    }
}
