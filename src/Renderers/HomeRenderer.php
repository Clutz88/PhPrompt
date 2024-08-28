<?php

declare(strict_types=1);

namespace Phprompt\Renderers;

use Chewie\Concerns\Aligns;
use Laravel\Prompts\Themes\Default\Renderer;
use Phprompt\App;
use Phprompt\Enums\CommandType;
use Phprompt\Models\History;

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
            ->map(fn (History $line) => match ($line->type()) {
                CommandType::command => $this->bold('$ ') . $line->output(),
                default => $line->output()
            })
            ->each($this->line(...));

        $this->line($this->bold('$ ') . $app->command);
        if ($app->result) {
            $this->line($app->result);
        }

        return $this;
    }
}
