<?php

namespace App\Exceptions;

use ArgumentCountError;
use Exception;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //dd($e);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function render($request, Throwable $exception)
    {

        if (substr($request->path(), 0, 3) == 'api') {
            if (!empty($exception)) {
                $status = Response::HTTP_INTERNAL_SERVER_ERROR;
                $response = [
                    'success' => false,
                    'message' => 'An error has occured'
                ];
                // display more info in debug mode
                if (config('app.debug')) {
                    $response['exception'] = [
                        'class' => get_class($exception),
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTrace()
                    ];
                }
                // api error
                if ($exception instanceof ConnectorResponseException) {
                    $response['message'] = 'API error';
                    switch ($exception->response->status())
                    {
                        case Response::HTTP_NOT_FOUND:
                        {
                            $response['message'] = 'Not found';
                            break;   
                        }
                        case Response::HTTP_BAD_REQUEST:
                        {
                            $response['message'] = 'One or more fields are incorrect';
                            break;   
                        }
                    }               

                // missing params
                } elseif (
                    $exception instanceof InvalidArgumentException ||
                    $exception instanceof ArgumentCountError
                ) {
                    $status = Response::HTTP_BAD_REQUEST;
                    $response['message'] = 'One or more invalid/missing parameters';

                // generic http
                } elseif (
                    $exception instanceof HttpException
                ) {
                    $status = $exception->getStatusCode();
                    $response['message'] = Response::$statusTexts[$exception->getStatusCode()];
                }
                return response()->json($response, $status);

            }
        }
    }

}
