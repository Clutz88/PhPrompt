<?php

declare(strict_types=1);

namespace App\Commands;

use App\Traits\StoresApp;
use App\Contracts\Command;

class PwdCommand implements Command
{
    use StoresApp;

    public function run($input): string
    {
        return $this->app()->current_working_directory;
    }
}
