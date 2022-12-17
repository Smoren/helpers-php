<?php

namespace Smoren\Helpers;

use Smoren\ExtendedExceptions\BadDataException;

class EnvHelper
{
    /**
     * @param string $key
     * @param $defaultValue
     * @return mixed|null
     * @throws BadDataException
     */
    public static function get(string $key, $defaultValue = null)
    {
        if($defaultValue === null && !isset($_ENV[$key])) {
            throw new BadDataException("key '{$key}' not found in .env", 1);
        }

        return $_ENV[$key] ?? $defaultValue;
    }
}
