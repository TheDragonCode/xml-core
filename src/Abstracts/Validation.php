<?php

namespace DragonCode\Core\Xml\Abstracts;

use DragonCode\Core\Xml\Exceptions\ValidatorException;
use DragonCode\Core\Xml\Interfaces\ValidationInterface;
use Illuminate\Support\Facades\Validator;

abstract class Validation implements ValidationInterface
{
    protected $items = [];

    public function __construct($items)
    {
        $this->items = (array) $items;

        $this->validate();
    }

    public function get(): array
    {
        return $this->items;
    }

    protected function rules(): array
    {
        return [];
    }

    private function validate()
    {
        $validator = Validator::make($this->items(), $this->rules());

        if ($validator->fails()) {
            $errors  = $validator->errors()->all();
            $message = \implode(PHP_EOL, $errors);

            throw new ValidatorException($message);
        }
    }

    private function items(): array
    {
        $items = $this->items;

        return \compact('items');
    }
}
