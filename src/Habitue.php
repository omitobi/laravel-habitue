<?php

namespace Habitue;

use GuzzleHttp\Client;
use Habitue\Clients\GuzzleClient;
use Habitue\Contracts\ClientInterface;
use Habitue\Contracts\HabitueInterface;
use Habitue\Contracts\ResponseInterface;
use Habitue\Integration\AbstractHabitue;
use Habitue\Integration\ClientResponse;
use Habitue\Integration\Collector;
use Habitue\Integration\Converter;
use Habitue\Integration\HabitueResponse;
use Habitue\Integration\Response;

class Habitue extends AbstractHabitue implements HabitueInterface
{
    private ClientResponse $response;

    private string $url;

    private array $data;

    public function __construct(string $url, array $data = [], array $config = [])
    {
        $this->url = $url;
        $this->data = $data;

        $this->initializeClient($config);
    }

    public function setHeaders(array $headers, bool $overwrite = false): HabitueInterface
    {
        $this->client->setHeaders($headers, $overwrite);

        return $this;
    }

    public function setBody(array $body, bool $overwrite = false): HabitueInterface
    {
        $this->client->setBody($body, $overwrite);

        return $this;
    }

    public function get($key = null)
    {
        $this->response = $this->client->get($this->url, $this->data);

        return $this->respond($key);
    }

    public function post($key = null)
    {
        $this->response = $this->client->post($this->url, $this->data);

        return $this->respond($key);
    }

    public function patch($key = null): Collector
    {
        $this->response = $this->client->patch($this->url, $this->data);

        return $this->respond($key);
    }

    public function put($key = null): Collector
    {
        $this->response = $this->client->put($this->url, $this->data);

        return $this->respond($key);
    }

    public function delete($key = null): Collector
    {
        $this->response = $this->client->delete($this->url, $this->data);

        return $this->respond($key);
    }

    private function respond($key = null)
    {
        if ($key) {
            return HabitueResponse::make($this->response)
                ->respond()
                ->get($key);
        }

        return HabitueResponse::make($this->response)->respond();
    }

    public function getResponse(): ClientResponse
    {
        return $this->response;
    }

    public static function make(string $url, array $data = []): HabitueInterface
    {
        return new static($url, $data);
    }
}
