<?php

namespace Habitue\Traits;

trait Getter
{
    // Trait Getter

    public function __call($method, $parameters)
    {
        if (method_exists($this, $method)) {
            return parent::__call($method, $parameters);
        }

        if (!(strlen($method) > 3 && strtolower(substr($method, 0, 3)) === 'get')) {
            return parent::__call($method, $parameters);
        }

        $value = $this->get(strtolower(substr($method, 3)));

        return is_array($value)
            ? $this->make($value)
            : $value;
    }
}