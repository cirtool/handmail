<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use ReflectionClass;

abstract class Field implements Renderable
{
    public string $name;

    protected abstract function view(): string;

    public function __construct(public array $config) {
        $properties = $this->properties();

        foreach ($config as $key => $value) {
            if ($properties->contains($key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function render()
    {
        return view($this->view(), get_object_vars($this));
    }

    public function data(array $input): Collection
    {
        return collect($input);
    }

    protected function properties(): Collection
    {
        return collect(['name']);
    }
}
