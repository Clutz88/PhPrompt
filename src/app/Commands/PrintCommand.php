<?php

namespace App\Commands;

use App\App;
use App\Contracts\Command;
use App\Traits\StoresApp;

class PrintCommand implements Command
{
    use StoresApp;

    public function run(string $input): string
    {
        return $input;
    }
}
