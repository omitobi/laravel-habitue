<?php

namespace Habitue\Contracts;

use Tightenco\Collect\Support\Collection;
use Habitue\Integration\Collectable;

interface CollectorInterface
{
    public function attach($response);

    public function detach();
}
