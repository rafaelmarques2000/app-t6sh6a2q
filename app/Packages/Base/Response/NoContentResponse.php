<?php

namespace App\Packages\Base\Response;

use App\Packages\Base\AbstractResponse;

class NoContentResponse extends AbstractResponse
{
    function getResponseData(): array
    {
        return [];
    }
}
