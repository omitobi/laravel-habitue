<?php

namespace Harbitue\Contracts;

interface ResponseInterface
{
    public function wrap(string $response);

    public function unwrap(): string;

    public function getWrapped(): CollectorInterface;

    public static function make(string $response);
}
