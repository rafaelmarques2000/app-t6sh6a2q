<?php

namespace App\Packages\Base;


abstract class AbstractResponse
{
    abstract function getResponseData(): array;

    public function createResponse(bool $error, ?string $message = null, ?int $errorCode = null): array
    {
        $response = ['error' => $error];
        if ($error) {
            $response['message'] = $message;
            $response['errorCode'] = $errorCode;
        }

        $response['data'] = $this->getResponseData();
        return $response;
    }
}
