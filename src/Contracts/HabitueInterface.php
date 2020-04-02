<?php

namespace Habitue\Contracts;

interface HabitueInterface
{
    public function setHeaders(array $data): HabitueInterface;

    public function setBody(array $body): HabitueInterface;

    public function get(string $url, array $data = []): ResponseInterface;

    public function post(string $url, array $data = []): ResponseInterface;

    public function patch(string $url, array $data = []): ResponseInterface;

    public function put(string $url, array $data = []): ResponseInterface;

    public function delete(string $url, array $data = []): ResponseInterface;

    public static function make($client = null): HabitueInterface;
}
