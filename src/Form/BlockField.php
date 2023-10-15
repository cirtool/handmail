<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Str;

class BlockField extends Field
{
    protected $fields = [];

    protected static function dataStructure(array $input): array
    {
        return [];
    }

    public static function setupFromArray(array $input): self
    {
        $block = new static;

        $block->data = array_merge([
            '_id' => (string) Str::uuid(),
            '_pos' => 0
        ], static::dataStructure($input));

        foreach ($input as $key => $value) {
            /** @var \Cirtool\Handmail\Form\Field */
            $className = config('handmail.fields.' . $value['type']);
            unset($value['type']);

            $field = $className::setupFromArray($input);
            $block->addField($key, $field);
        }

        return $field;
    }

    public function addField($key, $value): self
    {
        $this->fields[$key] = $value;
        return $this;
    }
}
