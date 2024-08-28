<?php

declare(strict_types=1);

namespace App\Commands;

use App\Traits\StoresApp;
use App\Contracts\Command;

class PrintCommand implements Command
{
    use StoresApp;

    public function run($input): string
    {
        return $input;
    }
}
