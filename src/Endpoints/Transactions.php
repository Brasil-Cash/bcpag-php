<?php

declare(strict_types=1);

namespace BCpag\Endpoints;

use BCpag\BCpag;
use BCpag\Routes;

final class Transactions{

    private $client;
    private $data;

    function __construct($client)
    {
        $this->client = $client;
    }

    public function refund(array $data)
    {
        return $this->client->request(
            BCpag::POST,
            Routes::transactions()->refund($data['id']),
            ['json' => $data]
        );
    }

}

