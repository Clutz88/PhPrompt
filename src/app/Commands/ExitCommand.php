<?php

namespace App\Commands;

use App\Contracts\Command;
use App\Traits\StoresApp;

class ExitCommand implements Command
{
    use StoresApp;

    public function run(string $input): string
    {
        $this->app()->terminal()->exit();

        return '';
    }
}
