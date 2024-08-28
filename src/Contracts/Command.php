<?php

declare(strict_types=1);

namespace Phprompt\Contracts;

use Phprompt\App;

interface Command
{
    public function __construct(App $app);

    public function run(string $input): string;
}
