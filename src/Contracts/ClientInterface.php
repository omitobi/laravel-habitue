<?php


namespace Habitue\Contracts;


interface ClientInterface
{
    public function get($url, $data);

    public function post($url, $data);

    public function delete($url, $data);

    public function patch($url, $data);

    public function put($url, $data);

    public function setHeaders(array $data, bool $overwrite = false): ClientInterface;

    public function setBody(array $body, bool $overwrite = false): ClientInterface;
}