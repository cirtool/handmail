<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;

class SelectField extends Field
{
    public string $label;

    public array $options = [];

    public string $emptyOption = '';

    public string $default = '';

    public function data(array $input): Collection
    {
        return parent::data($input)->merge(['value' => $this->default]);
    }

    protected function view(): string
    {
        return 'handmail::form.select-field';
    }

    protected function properties(): Collection
    {
        return parent::properties()
            ->merge(['label', 'options', 'emptyOption', 'default']);
    }
}
