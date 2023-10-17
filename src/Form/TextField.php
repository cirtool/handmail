<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;

class TextField extends Field
{
    public string $label;

    public string $default = '';

    public function data(): array
    {
        return ['value' => $this->default];
    }

    protected function view(): string
    {
        return '';
    }

    protected function properties(): Collection
    {
        return parent::properties()->merge(['default', 'label']);
    }
}
