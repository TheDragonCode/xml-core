<?php

namespace DragonCode\Core\Xml\Facades;

use DOMDocument;
use DOMElement;
use DOMImplementation;

use function ksort;

class Xml
{
    /** @var DOMDocument */
    protected $doc;

    /** @var DOMElement */
    protected $root;

    protected $skip_empty_attributes = false;

    public function __construct(string $root = 'root', array $attributes = [], bool $format_output = false)
    {
        $this->doc  = new DOMDocument('1.0', 'utf-8');
        $this->root = $this->doc->createElement($root);

        $this->doc->formatOutput = $format_output;

        $this->setAttributes($this->root, $attributes);
    }

    /**
     * Initialization Xml service from static sources.
     */
    public static function init(string $root = 'root', array $attributes = [], bool $format_output = false): self
    {
        return new self($root, $attributes, $format_output);
    }

    public function setSkipEmptyAttributes(): self
    {
        $this->skip_empty_attributes = true;

        return $this;
    }

    public function doctype($qualified_name = null, $public_id = null, $system_id = null): self
    {
        $implementation = new DOMImplementation();

        $doctype = $implementation->createDocumentType($qualified_name, $public_id, $system_id);

        $this->doc->appendChild($doctype);

        return $this;
    }

    public function addItem(array $parameters = [], string $element_name = 'item')
    {
        ksort($parameters);

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

    public function appendChild(DOMElement &$parent, DOMElement $child, bool $skip_empty = true)
    {
        if ($skip_empty && ! $child) {
            return;
        }

        $node = $this->doc->importNode($child, true);

        $parent->appendChild($node);
    }

    public function appendToRoot(DOMElement $element)
    {
        $this->appendChild($this->root, $element);
    }

    public function get(): string
    {
        $this->doc->appendChild($this->root);

        return $this->doc->saveXML();
    }

    /**
     * Add new attributes.
     *
     * @see  https://php.net/manual/en/domelement.setattribute.php
     */
    private function setAttributes(DOMElement &$element, array $attributes = [])
    {
        foreach ($attributes as $name => $value) {
            if ($this->skip_empty_attributes && empty($value)) {
                continue;
            }

            $element->setAttribute($name, $value);
        }
    }
}
