<?php

namespace DragonCode\Core\Xml\Abstracts;

use DragonCode\Core\Xml\Interfaces\ItemInterface;

abstract class Item implements ItemInterface
{
    protected $item = [];

    public function get(): array
    {
        return $this->item;
    }
}
