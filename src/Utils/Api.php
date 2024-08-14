<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class Api
{
    const HEADERS = [
        "Accept"       => "application/json",
        "Content-Type" => "application/json"
    ];

    private static $apiUrl;
    private static $apiKey;

    public function __construct(string $apiUrl, string $apiKey)
    {
        self::$apiKey = $apiKey;
        self::$apiUrl = $apiUrl;
    }

    protected function _get(string $endpoint, array $parameters = [])
    {
        return $this->sendRequest('GET', $endpoint, ['query' => $parameters]);
    }

    protected function _post(string $endpoint, array $data = [])
    {
        return $this->sendRequest('POST', $endpoint, ['body' => json_encode($data)]);
    }

    protected function _put(string $endpoint, array $data = [])
    {
        return $this->sendRequest('PUT', $endpoint, ['body' => json_encode($data)]);
    }

    protected function _patch(string $endpoint, array $data = [])
    {
        return $this->sendRequest('PATCH', $endpoint, ['body' => json_encode($data)]);
    }

    protected function _delete(string $endpoint, array $parameters = [])
    {
        return $this->sendRequest('DELETE', $endpoint, ['query' => $parameters]);
    }

    private function sendRequest(string $method, string $endpoint, array $options = [])
    {
        try {
            $client = self::__generateClient();
            $result = $client->request($method, $endpoint, $options);
            return self::__decodeResponse($result->getBody()->getContents());
        } catch (ClientException $e) {
            return self::__decodeResponse($e->getResponse()->getBody()->getContents());
        }
    }

    private static function __generateHeaders(): array
    {
        return array_merge(self::HEADERS, ['Api-Token' => self::$apiKey]);
    }

    private static function __generateClient(): Client
    {
        return new Client([
            'base_uri' => self::$apiUrl,
            'headers' => self::__generateHeaders()
        ]);
    }

    private static function __decodeResponse(string $response): object
    {
        return json_decode($response);
    }

    private static function dd($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }
}