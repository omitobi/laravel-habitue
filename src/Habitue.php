<?php

namespace Harbitue;

use GuzzleHttp\Client;
use Harbitue\Contracts\HarbitueInterface;
use Harbitue\Contracts\ResponseInterface;
use Harbitue\Integration\Response;

class Habitue implements HarbitueInterface
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

        return $this;
    }

    public function setBody(array $body, bool $replace = false)
    {
        $this->headers = $replace ? $body : ($this->body + $body);

        return $this;
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

    public static function make($client = null): HarbitueInterface
    {
        if ($client) {
            return new self($client);
        }

        if (function_exists('app')) {
            return new self(app(Client::class));
        }

        return new self(new Client());
    }
}
