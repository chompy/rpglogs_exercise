<?php

namespace App\Console\Commands;

use App\Connectors\FFXIVLodestoneConnector;
use Illuminate\Console\Command;

/**
 * Command that fetches a character avatar from the
 * Lodestone site.
 */
class FetchLodestoneAvatarCommand extends Command
{
    
    /**
     * {@inheritDoc}
     */
    protected $signature = 'app:lodestone-avatar {character-name} {server-name}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Fetch a character avatar parses from Lodestone.';

    /** @var FFXIVLodestoneConnector */
    protected $lodestoneConnector;

    /**
     * @param FFXIVLodestoneConnector $lodestoneConnector
     */
    public function __construct(
        FFXIVLodestoneConnector $lodestoneConnector
    ) {
        parent::__construct();
        $this->lodestoneConnector = $lodestoneConnector;
    }

    /**
     * {@inheritDoc}
     */
    public function handle()
    {
        $characterName = $this->argument('character-name');
        $serverName = $this->argument('server-name');
        $lodestoneConnector = new FFXIVLodestoneConnector;
        $avatarURL = $lodestoneConnector->fetchCharacterAvatarURL($characterName, $serverName);
        $this->comment($avatarURL);
    }

}