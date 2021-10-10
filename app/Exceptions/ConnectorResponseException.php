<?php

namespace App\Exceptions;

use Illuminate\Http\Client\Response;

class ConnectorResponseException extends \Exception
{

    /** @var Response */
    public $response;

}