<?php

namespace Helldar\Core\Xml\Facades;

use DOMDocument;
use DOMElement;

class Xml
{
    /** @var \DOMDocument */
    protected $doc;

    /** @var \DOMElement */
    protected $root;

    public function __construct(string $root = 'root', array $attributes = [], bool $format_output = false)
    {
        $this->doc  = new DOMDocument('1.0', 'utf-8');
        $this->root = $this->doc->createElement($root);

        $this->doc->formatOutput = $format_output;

        $this->setAttributes($this->root, $attributes);
    }

    /**
     * Initialization Xml service from static sources.
     *
     * @param string $root
     * @param array $attributes
     * @param bool $format_output
     *
     * @return \Helldar\Core\Xml\Facades\Xml
     */
    public static function init(string $root = 'root', array $attributes = [], bool $format_output = false): self
    {
        return new self($root, $attributes, $format_output);
    }

    public function addItem(array $parameters = [], string $element_name = 'item')
    {
        \ksort($parameters);

        $section = $this->doc->createElement($element_name);

        foreach ($parameters as $key => $value) {
            $elem = $this->doc->createElement($key, $value);
            $section->appendChild($elem);
        }

        $this->root->appendChild($section);
    }

    public function makeItem(string $name, $value = null, array $attributes = []): DOMElement
    {
        $element = $this->doc->createElement($name, $value);

        $this->setAttributes($element, $attributes);

        return $element;
    }

    public function appendChild(DOMElement &$parent, DOMElement $child)
    {
        $parent->appendChild($child);
    }

    public function appendToRoot(DOMElement $element)
    {
        $this->appendChild($this->root, $element);
    }

    /**
     * Add new attributes.
     *
     * @see  https://php.net/manual/en/domelement.setattribute.php
     *
     * @param \DOMElement $element
     * @param array $attributes
     */
    private function setAttributes(DOMElement &$element, array $attributes = [])
    {
        foreach ($attributes as $name => $value) {
            $element->setAttribute($name, $value);
        }
    }
}
