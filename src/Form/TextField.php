<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;

class TextField extends Field
{
    public string $label;

    public string $default = '';

    public function data(array $input): Collection
    {
        return parent::data($input)->merge(['value' => $this->default]);
    }

    protected function view(): string
    {
        return 'handmail::form.text-field';
    }

    protected function properties(): Collection
    {
        return parent::properties()->merge(['default', 'label']);
    }
}
