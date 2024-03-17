<?php

namespace App\Archiver;

use Illuminate\Http\Client\Response;

abstract class Archiver
{
    protected string $error;
    protected Response $response;

    public function getError(): string
    {
        return $this->error;
    }

    public function failed(): bool
    {
        return ! empty($this->error);
    }

}
