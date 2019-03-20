<?php

namespace Helldar\Core\Xml\Helpers;

class Str
{
    /**
     * Escape HTML special characters in a string.
     *
     * @param string $value
     *
     * @return string|null
     */
    public static function e($value): ?string
    {
        if (\is_null($value)) {
            return null;
        }

        return \htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}
