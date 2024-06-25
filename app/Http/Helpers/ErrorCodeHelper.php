<?php

declare(strict_types=1);

namespace App\Http\Helpers;

class ErrorCodeHelper
{
    public const BAD_REQUEST = 1;

    /**
     * @param $code
     *
     * @return string
     */
    public static function getMsgByCode($code): string
    {
        return self::errorCode()[$code] ?? "Code not found";
    }

    /**
     * Returns an array of error codes and their descriptions.
     *
     * @return string[]
     */
    public static function errorCode(): array
    {
        return [
            self::BAD_REQUEST           => "Incorrect request",
        ];
    }
}
