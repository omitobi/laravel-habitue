<?php

namespace Harbitue\Contracts;

interface ResponseInterface
{
    public function wrap($response);

    public function unwrap();

    public function getWrapped();

    public static function make($response);
}
