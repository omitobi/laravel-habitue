<?php

namespace Habitue\Clients;

use GuzzleHttp\Client;
use Habitue\Contracts\ClientInterface;
use Habitue\Integration\ClientResponse;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements ClientInterface
{
    private static Client $mockedClient;

    protected static bool $mocked = false;

    protected array $options = [
        'headers' => [],
    ];

    private array $body = [];

    public function __construct($options = [])
    {
        $this->options += $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function get($url, $data = [])
    {
        return $this->response(
            $this->client()->get($url, ['query' => $data])
        );
    }

    public function post($url, $data = [])
    {
        return $this->response(
            $this->client()->post($url, ['json' => $data])
        );
    }

    public function delete($url, $data = [])
    {
        return $this->response(
            $this->client()->delete($url, ['json' => $data])
        );
    }

    public function patch($url, $data = [])
    {
        return $this->response(
            $this->client()->patch($url, ['json' => $data])
        );
    }

    public function put($url, $data = [])
    {
        return $this->response(
            $this->client()->put($url, ['json' => $data]) //todo.use other type of data?
        );
    }

    private function response(ResponseInterface $response)
    {
        return new ClientResponse(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    public function setHeaders(array $data, bool $overwrite = false): ClientInterface
    {
        $this->options['headers'] = $overwrite ? $data : $this->options['headers'] + $data;
    }

    public function setBody(array $body, bool $overwrite = false): ClientInterface
    {
        $this->body = $overwrite ? $body : $this->body + $body;
    }

    private function client()
    {
//        $this->options['base_url'] = config('base_url');
        return self::$mocked
            ? self::$mockedClient
            : new Client($this->options);
    }

    public static function mock($client, $value = true)
    {
        self::$mocked = $value;

        self::$mockedClient = $client;
    }
}