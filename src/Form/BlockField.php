<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BlockField extends Field
{
    public string $label;

    protected Collection $fields;

    public function __construct(public array $config) {
        parent::__construct($config);
        $this->fields = collect();

        foreach ($config['fields'] as $key => $value) {
            /** @var \Cirtool\Handmail\Form\Field */
            $className = config('handmail.fields.' . $value['type']);
            $value = collect($value)->except(['type'])->toArray();

            $field = new $className($value);
            $this->addField($value['name'], $field);
        }
    }

    public function addField($key, $value): self
    {
        $this->fields[$key] = $value;
        return $this;
    }

    protected function view(): string
    {
        return 'handmail::form.block';
    } 

    public function data(array $input): Collection
    {
        return parent::data($input)->merge([
            'id' => Str::uuid(),
            'name' => $this->name,
            'position' => 0,
            'items' => $this->fields->map(
                    fn ($field) => $field->data(['model' => $input['model'] . '.items.' . $field->name])
                )->toArray()
        ]);
    } 

    protected function properties(): Collection
    {
        return parent::properties()->merge(['label']);
    }
}
