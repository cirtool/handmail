<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use ReflectionClass;

abstract class Field implements Renderable
{
    public string $name;

    public array $context = [];

    protected abstract function view(): string;

    public function __construct(public array $config) {
        $properties = $this->properties();

        foreach ($config as $key => $value) {
            if ($properties->contains($key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function renderForm()
    {
        return view($this->view(), get_object_vars($this));
    }

    public function render()
    {
        $values = collect($this->context['items'])->map(function ($item) {
            return $item['value'];
        });

        return view($this->name, $values->toArray());
    }

    public function data(array $input): Collection
    {
        return collect($input);
    }

    public function context(array $context): self
    {
        $this->context = $context;
        return $this;
    }

    protected function properties(): Collection
    {
        return collect(['name', 'isLayout']);
    }
}
