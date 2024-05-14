<?php

namespace Usmon\Microcore\Caching;

use Illuminate\Support\Facades\Redis;
use Illuminate\Redis\Connections\Connection as ConnectionRedis;

/**
 * @class PublicCaching
 * @author Usmon
 */
class PublicCaching
{
    /**
     * @return ConnectionRedis
     */
    private static function connection(): ConnectionRedis
    {
        return Redis::connection();
    }

    /**
     * @param string $key
     * @param string $id
     * @return string
     */
    private static function keyGenerate(string $key, string $id): string
    {
        return $key.'.'.$id;
    }

    /**
     * @param string $key
     * @param string $id
     * @param array $attributes
     * @return bool
     */
    public static function set(string $key, string $id, array $attributes): bool
    {
        return (bool)self::connection()->set(self::keyGenerate($key, $id), json_encode($attributes));
    }

    /**
     * @param string $key
     * @param string $id
     * @return mixed
     */
    public static function get(string $key, string $id): mixed
    {
        $item = self::connection()->get(self::keyGenerate($key, $id));
        if (is_null($item))
            return null;

        return json_decode($item, true);
    }

    /**
     * @param string $key
     * @param string $id
     * @return bool
     */
    public static function remove(string $key, string $id): bool
    {
        if (self::connection()->del(self::keyGenerate($key, $id)))
            return true;

        return false;
    }

    /**
     * @param string $key
     * @param string $id
     * @return bool
     */
    public static function exists(string $key, string $id): bool
    {
        if ( self::get($key, $id) )
            return true;

        return false;
    }
}
