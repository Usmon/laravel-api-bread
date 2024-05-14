<?php

namespace Usmon\Microcore\Interfaces;

interface ClientInterface
{
    /**
     * @param string $path
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function request(string $path, string $method, array $params): mixed;

    /**
     * @param string $cache_key
     * @param string $identifier
     * @param string $path
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function requestWithCache(string $cache_key, string $identifier, string $path, string $method, array $params): mixed;
}
