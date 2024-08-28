<?php

namespace App\Traits;

use App\App;

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
