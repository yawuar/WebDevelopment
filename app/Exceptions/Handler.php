<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if ($e instanceof ModelNotFoundException) {
        // $e = new NotFoundHttpException($e->getMessage(), $e);
        // }

        // if ($this->isHttpException($e))
        // {
        //     if($e->getStatusCode()===404 || $e->getStatusCode()===405)
        //     {
        //         return response()->view('errors.not-found', [], 404);
        //     }
        //     return $this->renderHttpException($e);
        // }
        return parent::render($request, $exception);
    }
}
