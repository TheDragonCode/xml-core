<?php

namespace DragonCode\Core\Xml\Helpers;

use function filter_var;

class Url
{
    /**
     * Validating a URL address.
     *
     * @param string $value
     *
     * @return bool
     *
     * @see https://secure.php.net/manual/en/function.filter-var.php
     */
    public static function isValid(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}
