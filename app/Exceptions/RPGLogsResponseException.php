<?php

namespace App\Exceptions;

use Illuminate\Http\Client\Response;

class RPGLogsResponseException extends \Exception
{

    /** @var Response */
    public $response;

}