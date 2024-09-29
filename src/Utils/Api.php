<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Utils;

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
        $ch = curl_init();
        $url = self::$apiUrl . $endpoint;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Api-Token: ' . self::$apiKey,
            'Accept: application/json',
            'Content-Type: application/json'
        ]);

        switch ($method) {
            case 'GET':
                if (!empty($options['query'])) {
                    $url .= '?' . http_build_query($options['query']);
                    curl_setopt($ch, CURLOPT_URL, $url);
                }
                break;
            case 'POST':
            case 'PUT':
            case 'PATCH':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                if (!empty($options['body'])) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $options['body']);
                }
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($options['query'])) {
                    $url .= '?' . http_build_query($options['query']);
                    curl_setopt($ch, CURLOPT_URL, $url);
                }
                break;
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL Error: $error");
        }

        curl_close($ch);

        return self::__decodeResponse($response);
    }

    private static function __generateHeaders(): array
    {
        return array_merge(self::HEADERS, ['Api-Token' => self::$apiKey]);
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