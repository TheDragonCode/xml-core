<?php

namespace Helldar\Core\Xml\Interfaces;

interface ValidationInterface
{
    public function __construct($items);

    public function get(): array;
}
