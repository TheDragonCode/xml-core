<?php

declare(strict_types=1);

namespace DragonCode\Core\Xml\Concerns;

use DOMElement;

trait Attributes
{
    /** @var bool */
    protected $skip_empty = false;

    protected function setAttributes(DOMElement &$element, array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            if (! $this->skip($value)) {
                $element->setAttribute($name, $value);
            }
        }
    }

    protected function skip($value): bool
    {
        return $this->skip_empty && empty($value);
    }
}
