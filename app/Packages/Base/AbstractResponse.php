<?php

namespace App\Packages\Base;


abstract class AbstractResponse
{
    abstract function getResponseData(): array;

    public function createResponse(bool $error, ?string $message = null, ?int $errorCode = null): array
    {
        $response = ['error' => $error];
        $response['message'] = $message;
        if ($error) {
            $response['errorCode'] = $errorCode;
        }
        $response['data'] = $this->getResponseData();
        return $response;
    }
}
