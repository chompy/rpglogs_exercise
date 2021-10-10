<?php

namespace App\Http\Controllers;

use App\Connectors\FFXIVLodestoneConnector;
use App\Http\Controllers\Controller;
use App\Connectors\RPGLogsConnector;
use App\Models\CharacterParseFetchHistory;
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
        // get inputs
        $characterName = $request->query('character');
        $serverName = $request->query('server');
        $serverRegion = $request->query('region');
        if (!$characterName || !$serverName || !$serverRegion) {
            throw new \InvalidArgumentException('Missing expected parameter. (character, server, region)');
        }
        // fetch parses
        $parses = $this->rpgLogsConnector->fetchCharacterParses(
            $characterName, $serverName, $serverRegion
        );

        // fetch avatar
        $avatarURL = $this->lodestoneConnector->fetchCharacterAvatarURL(
            $characterName,
            $serverName
        );
        // store fetch history
        CharacterParseFetchHistory::create([
            'character_name' => $characterName,
            'server_name' => $serverName,
            'server_region' => $serverRegion,
            'parse_count' => count($parses),
            'avatar_url' => $avatarURL
        ]);
        
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

    /**
     * Fetch history of character parse fetches.
     * @return JsonResponse
     */
    public function characterParsesHistory()
    {
        $res = CharacterParseFetchHistory::limit(10)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'type' => 'character_parses_history',
            'data' => $res
        ]);
    }

}