<?php

namespace DragonCode\Core\Xml\Helpers;

use function is_array;
use function is_object;
use function method_exists;

class Arr
{
    public static function toArray($object): array
    {
        foreach ($object as &$item) {
            if (is_object($item)) {
                if (method_exists($item, 'get')) {
                    $item = $item->get();
                }
                else {
                    $item = (array) $item;
                }
            }

            if (is_array($item) || is_object($item)) {
                self::toArray($item);
            }
        }

        return $object;
    }
}
