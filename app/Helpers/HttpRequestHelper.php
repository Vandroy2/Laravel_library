<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class HttpRequestHelper
{
    /**
     * @param $value mixed
     * @param $checkEmptyFunction boolean
     * @return boolean
     */

    public static function isEmptyParameter($value, $checkEmptyFunction = false): bool
    {
        return $value === ''
            || $value === []
            || $value === null
            || (is_string($value) && trim($value) === '')
            || ($checkEmptyFunction ? empty($value) : false);
    }


}
