<?php

namespace App\Commands;

use App\Contracts\Command;
use App\Traits\StoresApp;

class PwdCommand implements Command
{
    use StoresApp;

    public function run(string $input): string
    {
        return $this->app()->current_working_directory;
    }
}
