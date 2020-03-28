<?php

namespace Harbitue\Integration;

class Collectable
{
    private array $headers;

    private $content;

    private int $statusCode;

    public function __construct($content, int $statusCode, array $headers)
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
}
