<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Str;

abstract class Field
{
    public string $name;
    
    public array $data;

    protected static abstract function dataStructure(array $input): array;

    public static function setupFromArray(array $input): self
    {
        $field = new static;

        $field->data = array_merge([
            '_id' => (string) Str::uuid()
        ], static::dataStructure($input));

        return $field;
    }
}
