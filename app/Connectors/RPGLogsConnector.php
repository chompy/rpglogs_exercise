<?php

namespace App\Connectors;

use Illuminate\Http\Request;
class RPGLogsConnector extends AbstractConnector
{

    /** @var string */
    const QUERY_PARAM_API_KEY = 'api_key';

    /** @var string */
    const CHARACTER_PARSES_PATH = '/v1/parses/character/{characterName}/{serverName}/{serverRegion}';

    /** @var string */
    private $key;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->key = isset($config['key']) ? $config['key'] : '';
    }

    /**
     * Build query parameters nessacary to make API request.
     * @param array $query
     * @return array
     */
    protected function buildQuery(array $query = []) : array
    {
        $query = parent::buildQuery($query);
        $query[self::QUERY_PARAM_API_KEY] = $this->key;
        return $query;
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
        $resp = $this->request(
            $path,
            Request::METHOD_GET,
            $query
        );
        return json_decode($resp, true);
    }

}