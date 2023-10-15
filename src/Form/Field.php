<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Renderable;
use ReflectionClass;

abstract class Field implements Renderable
{
    public string $name;
    
    public array $data;

    protected static abstract function dataStructure(array $input): array;

    protected abstract function view(): string;

    public static function setupFromArray(array $input): self
    {
        $field = new static;

        $field->data = array_merge([
            '_id' => (string) Str::uuid()
        ], static::dataStructure($input));

        return $field;
    }

    public function render()
    {
        return view($this->view(), get_object_vars($this));
    }
}
