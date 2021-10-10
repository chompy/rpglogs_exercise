<?php

namespace App\Http\Controllers;

use App\Connectors\FFXIVLodestoneConnector;
use App\Http\Controllers\Controller;
use App\Connectors\RPGLogsConnector;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppApiController extends Controller
{

    /** @var RPGLogsConnector */
    protected $rpgLogsConnector;

    /** @var FFXIVLodestoneConnector */
    protected $lodestoneConnector;

    /**
     * @param RPGLogsConnector $rpgLogsConnector
     */
    public function __construct(
        RPGLogsConnector $rpgLogsConnector,
        FFXIVLodestoneConnector $lodestoneConnector
    ) {
        $this->rpgLogsConnector = $rpgLogsConnector;
        $this->lodestoneConnector = $lodestoneConnector;
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
        $parses = $this->rpgLogsConnector->fetchCharacterParses(
            $characterName, $serverName, $serverRegion
        );

        $avatarURL = $this->lodestoneConnector->fetchCharacterAvatarURL(
            $characterName,
            $serverName
        );
        return response()->json([
            'success' => true,
            'type' => 'character_parses',
            'data' => [
                'characterAvatarURL' => $avatarURL,
                'serverRegion' => strtoupper(trim($serverRegion)),
                'parses' => $parses
            ]
        ]);
    }

}