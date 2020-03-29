<?php

namespace Harbitue\Integration;

class Collectable
{
    private array $headers;

    private ?string $content;

    private int $statusCode;

    public function __construct(?string $content, int $statusCode, array $headers)
    {
        $this->setHeaders($headers)
            ->setContent($content)
            ->setStatusCode($statusCode);
    }
    
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }
    
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function toJson()
    {
        return json_encode(get_object_vars($this));
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
