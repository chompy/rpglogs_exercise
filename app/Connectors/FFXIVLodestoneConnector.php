<?php

namespace App\Connectors;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FFXIVLodestoneConnector extends AbstractConnector
{

    /** @var string */
    const LODESTONE_DOMAIN = 'na.finalfantasyxiv.com';

    /** @var string */
    const CHARACTER_ENDPOINT = '/lodestone/character/';

    public function __construct()
    {
        parent::__construct(['domain' => self::LODESTONE_DOMAIN]);
    }

    public function fetchCharacterAvatarURL(
        string $characterName,
        string $serverName
    ) : ?string {

        $resp = $this->request(
            self::CHARACTER_ENDPOINT,
            Request::METHOD_GET,
            $this->buildQuery([
                'q' => $characterName,
                'worldname' => $serverName
            ])
        );
        
        $doc = new \DOMDocument;
        libxml_use_internal_errors(true);
        $doc->loadHTML($resp, LIBXML_NOWARNING);
        
        $finder = new \DOMXPath($doc);
        $characterNodeList = $finder->query("//*[contains(@class, 'entry__chara__face')]");
        /** @var \DOMElement */
        $imgNode = $characterNodeList->item(0)->childNodes->item(0);
        return $imgNode->getAttribute('src');
    }

}