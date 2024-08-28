<?php

namespace App\Models;

use App\Enums\CommandType;

class History
{
    public function __construct(private CommandType $type, private string $output)
    {
        //
    }

    public function type(): CommandType
    {
        return $this->type;
    }

    public function output(): string
    {
        return $this->output;
    }
}
