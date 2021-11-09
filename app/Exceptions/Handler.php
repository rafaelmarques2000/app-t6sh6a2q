<?php

namespace App\Exceptions;

use App\Packages\Base\HttpStatus;
use App\Packages\Base\Response\ValidationErrorResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected function convertValidationExceptionToResponse(ValidationException $validationException, $request)
    {
        if($validationException->response) {
            return $validationException->response;
        }
        return response()->json(
            (new ValidationErrorResponse($validationException))->createResponse(true, 'falha ao validar request', $validationException->getCode()),
            HttpStatus::BAD_REQUEST
        );
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
