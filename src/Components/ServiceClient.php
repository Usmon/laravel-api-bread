<?php

namespace Usmon\Microcore\Components;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Usmon\Microcore\Caching\PublicCaching;
use Usmon\Microcore\Interfaces\ClientInterface;

/**
 * @class ServiceClient
 * @author Usmon
 */
class ServiceClient implements ClientInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $domain;

    /**
     * Construct
     */
    public function __construct(string $domain)
    {
        $this->client = new Client([
                                       'timeout'         => env('TIMEOUT', 10),
                                       'connect_timeout' => env('CONNECT_TIMEOUT', 3),
                                   ]);
        $this->setDomain($domain);
    }

    /**
     * @param string $domain
     * @return void
     */
    private function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @param $path
     * @return string
     */
    private function getUri($path): string
    {
        return $this->domain.'/'.$path;
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $params
     * @return array
     */
    private function transfer(string $path, string $method, array $params = []): array
    {
        try {
            $request = $this->client->request($method, $this->getUri($path), $params);
        }
        catch (GuzzleException $exception) {
            Log::error($exception->getMessage(), ['microcore/ServiceClient']);
            return [
                'failure' => true,
                'error_message' => $exception->getMessage()
            ];
        }

        return [
            'failure' => false,
            'status' => $request->getStatusCode(),
            'content' => json_decode($request->getBody(), true)
        ];
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function request(string $path, string $method ,array $params): mixed
    {
        $result = $this->transfer($path, $method, $params);
        if ($result['failure']) {
            return false;
        }

        return $result['content'];
    }

    /**
     * @param string $cache_key
     * @param string $identifier
     * @param string $path
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function requestWithCache(string $cache_key, string $identifier, string $path, string $method, array $params): mixed
    {
        $data = PublicCaching::get($cache_key, $identifier);
        if ($data)
            return $data;

        $request = $this->request($path, $method, $params);
        if ($request) {
            PublicCaching::set($cache_key, $identifier, $request);
        }

        return $request;
    }

    /**
     * @param string $cache_key
     * @param string $identifier
     * @param string $path
     * @param string $method
     * @param array $params
     * @param int $lifetime
     *
     * @return mixed
     */
    public function requestWithCacheAndLifetime(string $cache_key, string $identifier, string $path, string $method, array $params, int $lifetime): mixed
    {
        $data = PublicCaching::get($cache_key, $identifier);
        if ($data)
            return $data;

        $request = $this->request($path, $method, $params);
        if ($request) {
            PublicCaching::setWithLifetime($cache_key, $identifier, $request, $lifetime);
        }

        return $request;
    }
}
