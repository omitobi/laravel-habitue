<?php

namespace Harbitue\Contracts;

interface HarbitueInterface
{
    public function setHeader(array $data);

    public function setBody(array $body);

    public function get(string $url, array $data = []);

    public function post(string $url, array $data = []);

    public static function make($client = null): HarbitueInterface;
}
