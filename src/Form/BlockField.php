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

    protected function view(): string
    {
        return 'handmail::form.block';
    }

    public static function setupFromArray(array $input): self
    {
        $block = new static;

        $block->data = array_merge([
            '_id' => (string) Str::uuid(),
            '_pos' => 0,
            'items' => []
        ], static::dataStructure($input));

        $block->name = $input['name'];

        foreach ($input['fields'] as $key => $value) {
            /** @var \Cirtool\Handmail\Form\Field */
            $className = config('handmail.fields.' . $value['type']);
            unset($value['type']);

            $shortName = $value['name']; // Original field name

            $value['name'] = $block->name . '.items.' . $value['name']; // Override name prefixing parent name
            $field = $className::setupFromArray($value);
            
            $block->data['items'][$shortName] = $field->data;
            $block->addField($key, $field);
        }

        return $block;
    }

    public function addField($key, $value): self
    {
        $this->fields[$key] = $value;
        return $this;
    }
}
