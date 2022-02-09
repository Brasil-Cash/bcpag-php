<?php

declare(strict_types=1);

namespace BCpag\Endpoints;

use BCpag\BCpag;
use BCpag\Routes;

final class Links {

    private $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    public function create(array $data)
    {
        return $this->client->request(
            BCpag::POST,
            Routes::links()->base(),
            ['json' => $data]
        );
    }

    public function transactions(array $data)
    {
        return $this->client->request(
            BCpag::GET,
            Routes::links()->transactions($data['id']),
            ['json' => $data]
        );
    }
}