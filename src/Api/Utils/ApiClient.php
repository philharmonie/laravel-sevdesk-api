<?php
/*
 * ApiClient.php
 * @author Martin Appelmann <hello@martin-appelmann.de>
 * @copyright 2021 Martin Appelmann
 */

namespace Exlo89\LaravelSevdeskApi\Api\Utils;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ApiClient
{
    private $client;

    private function getClient(): Client
    {
        if (!$this->client) {
            $this->client = new Client([
                'base_uri' => $this->baseUrl(),
            ]);
        }
        return $this->client;
    }

    private function getToken(): string
    {
        return config('sevdesk-api.api_token');
    }

    private function baseUrl()
    {
        return 'https://my.sevdesk.de';
    }

    public function execute($httpMethod, $url, array $parameters = [])
    {
        try {
            $payload['headers'] = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => $this->getToken(),
            ];
            $payload['json'] = $parameters;
            $response = $this->getClient()->{$httpMethod}('api/v1/' . $url, $payload);
            $responseBody = json_decode((string) $response->getBody(), true);
            return $responseBody['objects'];
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
            return json_decode((string) $response->getBody(), true);
        }
    }

    // ========================= base methods ======================================

    public function get($url = null, $parameters = [])
    {
        return $this->execute('get', $url, $parameters);
    }

    public function post($url = null, array $parameters = [])
    {

        return $this->execute('post', $url, $parameters);
    }

    public function put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    public function patch($url = null, array $parameters = [])
    {
        return $this->execute('patch', $url, $parameters);
    }

    public function delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }
}
