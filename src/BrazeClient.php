<?php

namespace Braze;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use function GuzzleHttp\Psr7\stream_for;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ResponseInterface;

class BrazeClient
{
    const BASE_URI = 'rest.fra-01.braze.eu';

    /** @var Client */
    private $httpClient;

    /** @var string API ID authentication */
    private $apiKey;

    /** @var BrazeUserData */
    public $userData;

    /** @var string */
    private $baseUri;

    public function __construct(string $apiKey, string $endpoint = null)
    {
        $this->setDefaultClient();

        $this->apiKey = $apiKey;
        $this->baseUri = $endpoint ?? self::BASE_URI;

        $this->userData = new BrazeUserData($this);
    }

    private function setDefaultClient()
    {
        $this->httpClient = new Client();
    }

    /**
     * Sets GuzzleHttp client.
     */
    public function setClient(Client $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Sends POST request to Braze API.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function post(string $endpoint, array $datas = [])
    {
        $response = $this->httpClient->request('POST', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => $this->getAuthHeaders(),
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Braze API.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function put(string $endpoint, array $datas = [])
    {
        $response = $this->httpClient->request('PUT', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => $this->getAuthHeaders(),
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Braze API.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(string $endpoint, array $datas = [])
    {
        $response = $this->httpClient->request('DELETE', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => $this->getAuthHeaders(),
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(string $endpoint, array $datas = [])
    {
        $response = $this->httpClient->request('GET', $this->getUri().$endpoint, [
            'query' => $datas,
            'headers' => $this->getAuthHeaders(),
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Returns basic headers with authentication parameters.
     */
    private function getAuthHeaders(): array
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        if (!empty($this->apiKey)) {
            $headers['Authorization'] = 'Bearer '.$this->apiKey;
        }

        return $headers;
    }

    /**
     * Returns Braze API Uri.
     */
    private function getUri(): string
    {
        return 'https://'.$this->baseUri;
    }

    /**
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        if (class_exists(Utils::class)) {
            $stream = Utils::streamFor($response->getBody());
        } else {
            $stream = stream_for($response->getBody());
        }

        return json_decode($stream);
    }
}
