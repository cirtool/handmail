<?php

namespace Cirtool\Handmail\Form;

use Cirtool\Handmail\BlockType;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BlockField extends Field
{
    public string $label;

    public BlockType $type;

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

    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField($key, $value): self
    {
        $this->fields[$key] = $value;
        return $this;
    }

    public function getRenderData()
    {
        $data = [];

        foreach ($this->fields as $key => $field) {
            $data[$key] = 
                $field->context($this->context['items'][$key])->getRenderData();
        }
        
        return $data;
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

    public function saving(): array
    {
        foreach ($this->fields as $key => $field) {
            $field->context($this->context['items'][$key]);

            if (method_exists($field, 'saving')) {
                $field->saving();
            }

            $this->context['items'][$key] = $field->context;
        }

        return $this->context;
    }

    protected function properties(): Collection
    {
        return parent::properties()->merge(['label']);
    }
}
