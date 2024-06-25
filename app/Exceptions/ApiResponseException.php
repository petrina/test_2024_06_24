<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Http\Helpers\ErrorCodeHelper;
use Exception;

class ApiResponseException extends Exception
{

    /**
     * Creates and throws an exception based on the given error code.
     *
     * @param int $errorCode The error code used to identify the exception.
     *
     * @throws ApiResponseException If an error message is found for the given error code,
     * @return ApiResponseException This method does not return anything.
     *
     */
    public static function makeExceptionByCode(int $errorCode): self
    {
        $msg = ErrorCodeHelper::getMsgByCode($errorCode);

        throw new ApiResponseException($msg, $errorCode);
    }
}
