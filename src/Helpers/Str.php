<?php

namespace DragonCode\Core\Xml\Helpers;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str as IlluminateStr;

use function htmlspecialchars;
use function is_null;

class Str extends IlluminateStr
{
    /**
     * Escape HTML special characters in a string.
     *
     * @param \Illuminate\Contracts\Support\Htmlable|string $value
     *
     * @return string|null
     */
    public static function e($value = null): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if ($value instanceof Htmlable) {
            return $value->toHtml();
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}
