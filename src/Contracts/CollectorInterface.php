<?php

namespace Habitue\Contracts;

interface CollectorInterface
{
    public function setResponse(ClientResponseInterface $clientResponse);

    public function response(): ClientResponseInterface;

    public function statusCode(): int;

    public function headers(): array;
}
