<?php

namespace App\Packages\Base\Response;

use App\Packages\Base\AbstractResponse;

class ErrorResponse extends AbstractResponse
{
    function getResponseData(): array
    {
        return [];
    }
}
