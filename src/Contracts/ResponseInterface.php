<?php

namespace Habitue\Contracts;

interface ResponseInterface
{
    public function collect(): CollectorInterface;

    public function wrap($response): ResponseInterface;

    public function getWrapped();

    public function array(): array;

    public function json(): string;

    public function then(callable $closure): ResponseInterface;

    public static function make($response): ResponseInterface;
}
