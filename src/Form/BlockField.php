<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;

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

            $shortName = $value['name']; // Original field name

            $value['name'] = $this->name . '.items.' . $value['name']; // Override name prefixing parent name
            $field = new $className($value);
            
            $this->addField($shortName, $field);
        }
    }

    public function addField($key, $value): self
    {
        $this->fields[$key] = $value;
        return $this;
    }

    public function data(): array
    {
        return [
            'position' => 0,
            'items' => $this->fields->map(
                    fn ($field) => $field->data()
                )->toArray()
        ];
    }

    protected function view(): string
    {
        return 'handmail::form.block';
    }    

    protected function properties(): Collection
    {
        return parent::properties()->merge(['label']);
    }
}
