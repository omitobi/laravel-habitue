<?php

namespace Habitue\Contracts;

interface ResponseInterface
{
    public function wrap($response): ResponseInterface;

    public function getWrapped();

    public static function make($response): ResponseInterface;

    public function array(): array;

    public function json(): string;
}
