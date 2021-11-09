<?php

namespace App\Packages\Base\Response;


use App\Packages\Base\AbstractResponse;
use Illuminate\Validation\ValidationException;

class ValidationErrorResponse extends AbstractResponse
{

    private ValidationException $validationException;

    public function __construct(ValidationException $validationException)
    {
        $this->validationException = $validationException;
    }

    function getResponseData(): array
    {
        return $this->validationException->validator->errors()->toArray();
    }
}
