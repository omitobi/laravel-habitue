<?php

namespace Harbitue\Contracts;

use Tightenco\Collect\Support\Collection;
use Harbitue\Integration\Collectable;

interface CollectorInterface
{
    public function attach($response);

    public function detach();
}
