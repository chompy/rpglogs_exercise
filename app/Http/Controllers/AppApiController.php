<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RPGLogsConnector;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppApiController extends Controller
{

    /** @var RPGLogsConnector */
    protected $rpgLogsConnector;

    /**
     * @param RPGLogsConnector $rpgLogsConnector
     */
    public function __construct(
        RPGLogsConnector $rpgLogsConnector
    ) {
        $this->rpgLogsConnector = $rpgLogsConnector;
    }

    /**
     * Fetch recent character parses from RPGLogs.
     * @param Request $request
     * @return JsonResponse
     */
    public function characterParses(Request $request)
    {
        $characterName = $request->query('character');
        $serverName = $request->query('server');
        $serverRegion = $request->query('region');
        if (!$characterName || !$serverName || !$serverRegion) {
            throw new \InvalidArgumentException('Missing expected parameter. (character, server, region)');
        }
        $res = $this->rpgLogsConnector->fetchCharacterParses(
            $characterName, $serverName, $serverRegion
        );
        return response()->json([
            'success' => true,
            'type' => 'character_parses',
            'data' => $res
        ]);
    }

}