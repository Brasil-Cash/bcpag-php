<?php

declare(strict_types=1);

namespace BCpag;

use BCpag\Endpoints\Transactions;
use BCpag\ClientBuilder;
use BCpag\Endpoints\Links;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as ClientException;


final class BCpag
{
    const BASE_ENDPOINT = "https://api.brasilcash.com.br/ecommerce";
    const VERSION = 'v1';
    const POST = 'POST';
    const GET = 'GET';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';

    private $api_key;
    
    private $http;

    public function __construct(string $api_key, array $extras = null)
    {
        $this->api_key = $api_key;

        $options = ['base_uri' => self::BASE_ENDPOINT];

        $options['headers'] = [
            'Authorization' => "Bearer " . $this->api_key,
        ];

        if(!empty($extras)){
            $options = array_merge($options, $extras);
        }

        $this->http = new HttpClient($options);
    }
    
    public function transactions(): Transactions
    {
        return new Transactions($this);
    }

    public function links(): Links
    {
        return new Links($this);
    }

    public function request($method, $uri, $options = [])
    {
        try {

            $response = $this->http->request(
                $method,
                BCpag::VERSION . '/'. $uri,
                $options
            );
            
            return BCpagResponse::response((string) $response->getBody());

        } catch (ClientException $exception) {
            return BCpagResponse::fail($exception);
        }
    }
}