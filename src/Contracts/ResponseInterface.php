<?php

namespace Harbitue\Contracts;

interface ResponseInterface
{
    public function wrap($response);

    public function getWrapped();

    public static function make($response);
}
