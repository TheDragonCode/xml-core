<?php

declare(strict_types=1);

namespace DragonCode\Core\Xml\Services\Elements;

use DOMDocument;
use DOMElement;
use DragonCode\Core\Xml\Concerns\Attributes;
use DragonCode\Support\Concerns\Makeable;

/**
 * @method static Doc make(string $root = 'root', array $attributes = [], bool $format_output = false)
 */
class Doc
{
    use Attributes;
    use Makeable;

    /** @var \DOMDocument */
    protected $doc;

    /** @var \DOMElement */
    protected $root;

    protected $version = '1.0';

    protected $encoding = 'utf-8';

    public function __construct(string $root = 'root', array $attributes = [], bool $format_output = false)
    {
        $this->doc = new DOMDocument($this->version, $this->encoding);

        $this->root = $this->doc->createElement($root);

        $this->doc->formatOutput = $format_output;

        $this->setAttributes($this->root, $attributes);
    }

    public function getDoc(): DOMDocument
    {
        return $this->doc;
    }

    public function getRoot(): DOMElement
    {
        return $this->root;
    }
}
