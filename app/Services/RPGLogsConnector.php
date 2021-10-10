<?php

namespace App\Services;

use App\Exceptions\RPGLogsResponseException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RPGLogsConnector
{

    /** @var string */
    const QUERY_PARAM_API_KEY = 'api_key';

    /** @var int */
    const CACHE_TTL = 120;

    /** @var string */
    const CHARACTER_PARSES_PATH = '/v1/parses/character/{characterName}/{serverName}/{serverRegion}';

    /** @var string */
    private $domain;

    /** @var string */
    private $key;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->domain = isset($config['domain']) ? $config['domain'] : '';
        $this->key = isset($config['key']) ? $config['key'] : '';
    }

    /**
     * Get full URL for given path.
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function getFullUrl($path) : string 
    {
        return sprintf(
            "https://%s/%s",
            $this->domain,
            ltrim($path, '/')
        );
    }

    /**
     * Resolve path and all of its path parameters.
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function resolvePath(string $path, array $params = []) : string
    {
        foreach ($params as $key => $val) {
            $path = str_replace('{' . $key . '}', trim($val), $path);
        }
        return trim($path);
    }

    /**
     * Build query parameters nessacary to make API request.
     * @param array $query
     * @return array
     */
    protected function buildQuery(array $query = []) : array
    {
        $query[self::QUERY_PARAM_API_KEY] = $this->key;
        return $query;
    }

    /**
     * Create a key to use
     * @param string $path
     * @param array $query
     */
    protected function getCacheKey(string $path, array $query = []) : string
    {
        return 'rpglogs_resp_' . hash('sha256', $path . http_build_query($query));
    }

    /**
     * Cache a response.
     * @param Response $resp
     * @param string $path
     * @param array $query
     */
    protected function cacheResponse(Response $resp, string $path, array $query = [])
    {
        // only cache 200 responses
        if (!$resp->ok()) {
            return;
        }
        $cacheKey = $this->getCacheKey($path, $query);
        Cache::put($cacheKey, $resp->json(), self::CACHE_TTL);
    }

    /**
     * Retrieve cached response.
     * @param string $path
     * @param array $query
     * @return array|null
     */
    protected function getCachedResponse(string $path, array $query = []) : ?array
    {
        $cacheKey = $this->getCacheKey($path, $query);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        return null;
    }

    /**
     * Make a request to RPGLogs API.
     * @param string $path
     * @param string $method
     * @param array $query
     * @param array $body
     * @throws RPGLogsResponseException
     * @return array
     */
    protected function request(
        string $path,
        string $method = Request::METHOD_GET,
        array $query = [],
        array $body = []
    ) : array {

        // used cached response if available
        if ($method == Request::METHOD_GET) {
            if ($resp = $this->getCachedResponse($path, $query)) {
                return $resp;
            }
        }
        // peform request
        $url = $this->getFullUrl($path);
        $resp = Http::send(
            $method,
            $url,
            [
                'query' => $this->buildQuery($query),
                'multipart' => $body
            ]
        );
        // cache response if possible
        if ($method == Request::METHOD_GET) {
            $this->cacheResponse($resp, $path, $query);
        }
        // invalid response
        if (!$resp->ok()) {
            $e = new RPGLogsResponseException(
                sprintf(
                    'Request to %s returned unexpected %d status code.',
                    $url,
                    $resp->status()
                )
            );
            $e->response = $resp;
            throw $e;
        }
        // success
        return $resp->json();
    }

    /**
     * Fetch recent character parses.
     * @param string $characterName
     * @param string $serverName
     * @param string $serverRegion
     * @return array
     */
    public function fetchCharacterParses(
        string $characterName, 
        string $serverName, 
        string $serverRegion
    ) : array {

        $path = $this->resolvePath(self::CHARACTER_PARSES_PATH, [
            'characterName' => $characterName,
            'serverName' => $serverName,
            'serverRegion' => $serverRegion
        ]);
        $query = ['includeCombatantInfo' => true];
        return $this->request(
            $path,
            Request::METHOD_GET,
            $query
        );
    }

}