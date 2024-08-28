<?php

namespace App\Contracts;

use App\App;

interface Command
{
    public function __construct(App $app);

    public function run(string $input): string;
}
