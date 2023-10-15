<?php

namespace Cirtool\Handmail\Form;

class TextField extends Field
{
    public string $label;

    protected static function dataStructure(array $input): array
    {
        $value = isset($input['default']) ? $input['default'] : '';
        return ['value' => $value];
    }
}
