<?php

declare(strict_types=1);

namespace Phprompt\Commands;

use Phprompt\Contracts\Command;
use Phprompt\Traits\StoresApp;

class PrintCommand implements Command
{
    use StoresApp;

    public function run(string $input): string
    {
        return $input;
    }
}
