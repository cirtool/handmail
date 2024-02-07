<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;

class ColorField extends Field
{
    public string $label;

    public string $default = '';

    public function data(array $input): Collection
    {
        return parent::data($input)->merge(['value' => $this->default]);
    }

    protected function view(): string
    {
        return 'handmail::form.color-field';
    }

    protected function properties(): Collection
    {
        return parent::properties()->merge(['default', 'label']);
    }
}
