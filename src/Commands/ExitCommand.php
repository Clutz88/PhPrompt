<?php

namespace Phprompt\Commands;

use Phprompt\Contracts\Command;
use Phprompt\Traits\StoresApp;

class ExitCommand implements Command
{
    use StoresApp;

    public function run(string $input): string
    {
        $this->app()->terminal()->exit();

        return '';
    }
}
