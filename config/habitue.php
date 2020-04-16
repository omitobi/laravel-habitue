<?php

return [

    /*------------------------------------------|
     * Declare configuration values here        |
     *                                          |
     *------------------------------------------|
     */

    'client' => 'guzzle',

    'handler_stack' => 'default',

    'default_options' => [

        'headers' => [
            'content-type' => 'application/json',
            'accept' => 'application/json'
        ],
    ],

    'return' => [

        'type' => 'collection',  //|array|json|raw|object|model,

        'model' => \Habitue\Models\Model::class // Model is used if type is model (optional)
    ]
];