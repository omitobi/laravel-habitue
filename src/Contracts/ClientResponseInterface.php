<?php

namespace Habitue\Contracts;

interface ClientResponseInterface
{
    public function getData(): string;

    public function getStatusCode(): int;

    public function getHeaders(): array;
}