<?php

namespace BingNewsSearch\Requests;

use BingNewsSearch\Client;

abstract class SubRequest
{
    public function __construct(private readonly Client $client, ...$args)
    {   
        if (method_exists($this, "initialize")) call_user_func_array([$this, "initialize"], $args);
    }

    public function factory($request, ...$args)
    {
        $request = static::class."\\".ucfirst((string) $request);
        if (!class_exists($request)) throw new \BadMethodCallException("Request $request not exists");
        return new $request($this->client, ...$args);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}