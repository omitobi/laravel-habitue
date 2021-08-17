<?php

namespace Habitue\Integration;

class Converter
{
    /**
     * @var string
     */
    private string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function toJson()
    {
        return $this->data;
    }

    public function toObject()
    {
        return json_decode($this->data);
    }

    public function toArray()
    {
        return json_decode($this->data, true);
    }

    public function toModel(string $class)
    {
        //todo.update to autofill the class with the data
        return new $class();
    }

    public function toCollection()
    {
        return new Collector($this->toArray());
    }
}