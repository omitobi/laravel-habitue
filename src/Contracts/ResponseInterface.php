<?php

namespace Habitue\Contracts;

use Closure;

interface ResponseInterface
{
    public function wrap($response): ResponseInterface;

    public function getWrapped();

    public function array(): array;

    public function json(): string;

    public function then(Closure $closure): ResponseInterface;

    public static function make($response): ResponseInterface;
}
