<?php

namespace Habitue\Integration;

class HabitueResponse
{
    /**
     * @var ClientResponse
     */
    private ClientResponse $clientResponse;

    public function __construct(ClientResponse $clientResponse)
    {
        $this->clientResponse = $clientResponse;
    }

    public function respond()
    {
        [$type, $model] = $this->getReturn();

        $converter = new Converter($this->clientResponse->getData());

        switch ($type) {
            case 'json':
                $response = $converter->toJson();
                break;
            case 'array':
                $response = $converter->toArray();
                break;
            case 'object':
                $response = $converter->toObject();
                break;
            case 'model':
                $response = $converter->toModel($model);
                break;
            case 'collection':
            default:
                $response = $converter->toCollection()
                    ->setResponse($this->clientResponse);
                break;
        }

        return $response;
    }

    protected function getReturn(): array
    {
        // return config('habitue.return')

        return array_values([
            'type' => 'collection',  //|array|json|raw|object|model,

            'model' => \Habitue\Models\Model::class // Model is used if type is model (optional)
        ]);
    }

    public static function make(ClientResponse $clientResponse)
    {
        return new static($clientResponse);
    }
}