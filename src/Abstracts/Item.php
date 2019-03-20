<?php

namespace Helldar\Core\Xml\Abstracts;

use Helldar\Core\Xml\Interfaces\ItemInterface;

abstract class Item implements ItemInterface
{
    protected $item = [];

    public function get(): array
    {
        return $this->item;
    }
}
