<?php

namespace App\Console\Commands;

use App\Services\RPGLogsConnector;
use Illuminate\Console\Command;

/**
 * Command that fetches a given character's most recent
 * RPGLogs parses.
 */
class FetchCharacterParsesCommand extends Command
{
    
    /**
     * {@inheritDoc}
     */
    protected $signature = 'app:character-parses {character-name} {server-name} {server-region}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Fetch a character\'s recent parses from RPGLogs.';

    /** @var RPGLogsConnector */
    protected $rpgLogsConnector;

    /**
     * @param RPGLogsConnector $rpgLogsConnector
     */
    public function __construct(
        RPGLogsConnector $rpgLogsConnector
    ) {
        $this->rpgLogsConnector = $rpgLogsConnector;
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    public function handle()
    {
        $characterName = $this->argument('character-name');
        $serverName = $this->argument('server-name');
        $serverRegion = $this->argument('server-region');
        $res = $this->rpgLogsConnector->fetchCharacterParses(
            $characterName,
            $serverName,
            $serverRegion
        );
        $this->comment(json_encode($res, JSON_PRETTY_PRINT));
    }

}