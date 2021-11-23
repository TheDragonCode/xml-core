<?php

declare(strict_types=1);

namespace DragonCode\Core\Xml\Services;

use DragonCode\Core\Xml\Services\Elements\Doc;
use DragonCode\Support\Concerns\Makeable;

/**
 * @method static Document make(string $root = 'root', array $attributes = [], bool $format_output = false)
 */
class Document
{
    use Makeable;

    /** @var \DragonCode\Core\Xml\Services\Elements\Doc */
    protected $doc;

    public function __construct(string $root = 'root', array $attributes = [], bool $format_output = false)
    {
        $this->doc = Doc::make($root, $attributes, $format_output);
    }
}
