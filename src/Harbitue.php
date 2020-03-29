<?php

namespace Harbitue;

use GuzzleHttp\Client;
use Harbitue\Contracts\HarbitueInterface;
use Harbitue\Contracts\ResponseInterface;
use Harbitue\Integration\Response;

class Harbitue implements HarbitueInterface
{
    /**
     * @var Client
     */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private array $headers = [
        'accept' => 'application/json'
    ];

    private array $body = [];

    private ResponseInterface $response;

    public function setHeader(array $headers, bool $replace = false)
    {
        $this->headers = $replace ? $headers : ($this->headers + $headers);
    }

    public function setBody(array $body, bool $replace = false): void
    {
        $this->headers = $replace ? $body : ($this->body + $body);
    }

    public function get(string $url, array $data = [])
    {
        $this->response = Response::make($this->client->get($url, [
            'headers' => $this->headers,
            'query' => $data ?: $this->body
        ]));

        return $this->response;
    }

    public function post(string $url, array $data = [])
    {
        $this->response = Response::make(
            $this->client->get($url, [
                'headers' => $this->headers,
                'json' => $data ?: $this->body
            ])
        );

        return $this->response;
    }
}
