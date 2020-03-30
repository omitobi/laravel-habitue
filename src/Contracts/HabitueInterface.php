<?php

namespace Habitue\Contracts;

interface HabitueInterface
{
    public function setHeaders(array $data): HabitueInterface;

    public function setBody(array $body): HabitueInterface;

    public function get(string $url, array $data = []);

    public function post(string $url, array $data = []);

    public static function make($client = null): HabitueInterface;
}
