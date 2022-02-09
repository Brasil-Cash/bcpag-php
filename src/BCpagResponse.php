<?php

namespace BCpag;

use GuzzleHttp\Exception\ClientException;

final class BCpagResponse{


    public static function response($response){
        return self::json($response);
    }

    public static function fail($response)
    {
        return self::parseException($response);
    }

    protected static function json($json){
        $response = json_decode($json);

        if (json_last_error() != \JSON_ERROR_NONE) {
            throw new \Exception(json_last_error_msg());
        }

        return $response;
    }

    private static function parseException(ClientException $guzzleException)
    {
        $response = $guzzleException->getResponse();

        if (is_null($response)) {
            return $guzzleException;
        }

        $body = $response->getBody()->getContents();

        try {
            $jsonError = self::json($body);
        } catch (\Exception $invalidJson) {
            return $guzzleException;
        }

        return $jsonError;
    }

}