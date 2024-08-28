<?php

declare(strict_types=1);

namespace Phprompt\Traits;

use Phprompt\App;

trait StoresApp
{
    public function __construct(protected App $app)
    {
        //
    }

    public function app(): App
    {
        return $this->app;
    }
}
